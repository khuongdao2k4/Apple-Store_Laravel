<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;
use App\Helpers\ColorHelper;

class OrderController extends Controller
{
    public function order(Request $request) { // 
        $series = $request->query('series');
        $id = $request->query('id');
        
        if ($series) {
            // Lấy tất cả sản phẩm và options thuộc dòng sản phẩm được chọn
            $products = Product::with('options.attribute')->where('series', $series)->orderBy('sort_order', 'asc')->get();
            
            if ($products->isEmpty()) {
                return redirect()->route('home')->with('error', 'Không tìm thấy dòng sản phẩm này.');
            }
            
            $firstProduct = $products->first(); // Lấy sản phẩm đầu tiên để lấy tên dòng sản phẩm
            $seriesTitle = $firstProduct->series_title ?? $firstProduct->series;// Lấy tiêu đề hiển thị của dòng máy, nếu không có thì lấy tên series gốc.
            $category = (str_contains(strtolower($series), 'iphone')) ? 'iphone' : 'mac'; // Lấy danh mục sản phẩm dựa vào tên dòng sản phẩm
            
            return view('pages.order', compact('products', 'seriesTitle', 'category'));// Trả về view order với danh sách sản phẩm, tiêu đề dòng máy và danh mục
        
        } elseif ($id) { // ngược lại, nếu người dùng truyền tham số ID sản phẩm cụ thể 
            $product = Product::with('options.attribute')->find($id);// Lấy sản phẩm được chọn từ id
            
            if (!$product) {
                return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại.');
            }

            // Lấy tất cả sản phẩm cùng dòng sản phẩm
            $products = Product::with('options.attribute')// Tải trước các thuộc tính của sản phẩm
                ->where('series', $product->series)// Lọc ra các sản phẩm cùng dòng sản phẩm với sản phẩm được chọn
                ->orderBy('sort_order', 'asc')// Sắp xếp các sản phẩm theo thứ tự hiển thị
                ->get();
                
            $seriesTitle = $product->series_title ?? $product->series; // Lấy tiêu đề hiển thị của dòng máy, nếu không có thì lấy tên series gốc.
            $category = (str_contains(strtolower($product->series), 'iphone')) ? 'iphone' : 'mac';// Lấy danh mục sản phẩm dựa vào tên dòng sản phẩm
            
            return view('pages.order', compact('products', 'seriesTitle', 'category'));// Trả về view order với danh sách sản phẩm, tiêu đề dòng máy và danh mục
        }
        
        // Nếu không có tham số series hoặc id, hiển thị tất cả sản phẩm
        $products = Product::with('options.attribute')->all();// Tải trước các thuộc tính của tất cả sản phẩm
        $seriesTitle = 'Sản phẩm';// Tiêu đề dòng sản phẩm
        $category = 'general';// Danh mục sản phẩm
        return view('pages.order', compact('products', 'seriesTitle', 'category'));// Trả về view order với danh sách sản phẩm, tiêu đề dòng máy và danh mục
    }

    public function checkout(Request $request) {// Xử lý thanh toán
        if (!session()->has('user_name')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $email = session('email');
        $cartItems = CartItem::where('email', $email)->get(); // Lấy giỏ hàng từ db

        $isDirectBuy = false; // Kiểm tra xem có phải mua ngay không
        
        if ($request->query('product')) { // Kiểm tra xem có tham số product không
            $isDirectBuy = true; 
            $item = [
                'product_name' => $request->query('product'),// Lấy tên sản phẩm
                'price' => $request->query('price'),// Lấy giá sản phẩm
                'storage' => $request->query('storage'),// Lấy dung lượng sản phẩm
                'color' => $request->query('color'),// Lấy màu sắc sản phẩm
                'image_url' => $request->query('image_url'),
                'quantity' => 1,
                'applecare' => $request->query('applecare') == '1'
            ];
            $cartItems = collect([ (object)$item ]); // Chuyển đổi item thành object và thêm vào cartItems
        }

        $totalPrice = 0; // Khởi tạo tổng giá
        foreach ($cartItems as $item) { // Lặp qua giỏ hàng
            $item->color = ColorHelper::resolve($item->color); // Giải mã màu sắc chuyển thành tên màu

            // Lấy giá sản phẩm chỉ lấy số, loại bỏ ký tự đặc biệt
            $priceStr = preg_replace('/[^0-9]/', '', $item->price); 
            $priceVal = intval($priceStr); // chuyển chuỗi số trên thành integer
            
            $item->price_numeric = $priceVal;
            $totalPrice += $priceVal * $item->quantity;// Cộng dồn tổng = giá sp * soluong
        }

        return view('pages.checkout', compact('cartItems', 'totalPrice', 'isDirectBuy'));
    }

    public function processOrder(Request $request) { // Xử lý khi người dùng ấn nút Đặt hàng
        try {
            if (!session()->has('user_name')) {
                return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập.'], 401);
            }

            $request->validate([ // Xử lý validation khi người dùng nhập thông tin
                'phone' => ['required', 'regex:/^(0[3|5|7|8|9])+([0-9]{8})$/'], // Yêu cầu số điện thoại bắt đầu bằng 03, 05, 07, 08, 09 và có 10 chữ số
                'address' => 'required|min:10',// Yêu cầu địa chỉ có ít nhất 10 ký tự
                'payment_method' => 'required|in:COD,VNPAY'
            ], [
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.regex' => 'Số điện thoại không hợp lệ (phải là số điện thoại Việt Nam gồm 10 chữ số).',
                'address.required' => 'Địa chỉ nhận hàng không được bỏ trống.',
                'address.min' => 'Địa chỉ nhận hàng quá ngắn (tối thiểu 10 ký tự).',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
                'payment_method.in' => 'Phương thức thanh toán không hợp lệ.'
            ]);

            $email = session('email');
            $cartItems = CartItem::where('email', $email)->get();
            
            $totalPriceNumeric = 0;
            $orderIds = [];
            
            $isDirectBuy = $request->input('is_direct_buy') == '1';

            if ($isDirectBuy && $request->has('product')) {// xử lý thanh toán khi mua ngay

                $priceStr = $request->input('price');
                $priceVal = intval(preg_replace('/[^0-9]/', '', $priceStr));
                $totalPriceNumeric = $priceVal;

                $itemData = [// Tạo 1 mảng chứa thông tin sản phẩm để lưu vào cột Json items
                    [
                        'product_name' => $request->input('product'),
                        'image_url' => $request->input('image_url'),
                        'storage' => $request->input('storage'),
                        'color' => ColorHelper::resolve($request->input('color')),
                        'price' => $priceVal,
                        'quantity' => 1,
                        'applecare' => $request->input('applecare') == '1',
                    ]
                ];

                $order = Order::create([// Gọi model Order để tạo đơn hàng mới
                    'username' => session('user_name'),
                    'email' => $email,
                    'product' => $request->input('product'),
                    'items' => $itemData,
                    'image_url' => $request->input('image_url'),
                    'storage' => $request->input('storage'),
                    'color' => ColorHelper::resolve($request->input('color')),
                    'price' => $priceVal,
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'payment_method' => $request->input('payment_method', 'COD'),
                    'status' => 'pending',
                ]);
                $orderIds[] = $order->id_order; // Lưu ID đơn hàng vào mảng


            } elseif (!$cartItems->isEmpty()) {// Xử lý thanh toán khi mua từ giỏ hàng

                $productNames = [];// mảng chứa tên các sản phẩm
                $firstImageUrl = $cartItems->first()->image_url;
                $storages = [];
                $colors = [];
                $itemData = [];
                
                foreach ($cartItems as $item) {//VÒng lặp gộp dữ liệu các sản phẩm giỏ hàng
                    $itemPriceVal = intval(preg_replace('/[^0-9]/', '', $item->price));
                    $totalPriceNumeric += $itemPriceVal * $item->quantity;
                    $productNames[] = $item->product_name . " (x" . $item->quantity . ")";// thêm tên sp kèm số lượng vào danh sách sp
                    
                    // gộp dung lượng và màu  duy nhất vào mảng(!in_array tránh trùng lặp)
                    if (!in_array($item->storage, $storages)) $storages[] = $item->storage;
                    if (!in_array($item->color, $colors)) $colors[] = ColorHelper::resolve($item->color);

                    $itemData[] = [ //  tạo mảng gộp các cấu hình của từng sản phẩm
                        'product_name' => $item->product_name,
                        'image_url' => $item->image_url,
                        'storage' => $item->storage,
                        'color' => ColorHelper::resolve($item->color),
                        'price' => $itemPriceVal,
                        'quantity' => $item->quantity,
                        'applecare' => (bool)$item->applecare,
                    ];
                }

                $order = Order::create([
                    'username' => session('user_name'),
                    'email' => $email,
                    'product' => \Illuminate\Support\Str::limit(implode(', ', $productNames), 250),
                    'items' => $itemData,
                    'image_url' => $firstImageUrl,
                    //Str::limit và implode để nối các tên sản phẩm, màu sắc, cấu hình thành chuỗi ngăn cách bởi dấu phẩy 
                    'storage' => \Illuminate\Support\Str::limit(implode(', ', $storages), 250),
                    'color' => \Illuminate\Support\Str::limit(implode(', ', $colors), 250),
                    'price' => $totalPriceNumeric,
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'payment_method' => $request->input('payment_method', 'COD'),
                    'status' => 'pending',
                ]);
                $orderIds[] = $order->id_order; // Lưu ID đơn hàng mới tạo vào mảng
            } else {
                return response()->json(['success' => false, 'message' => 'Giỏ hàng trống hoặc thiếu thông tin sản phẩm.'], 400);
            }

            // Thanh toán qua VNpay
            if ($request->input('payment_method') === 'VNPAY') {
                $vnp_Url = env('VNP_URL');//lấy cấu hình cổng thanh toán từ .env
                $vnp_HashSecret = env('VNP_HASHSECRET');
                $vnp_TmnCode = env('VNP_TMNCODE');

                $vnp_TxnRef = $orderIds[0];// gán mã tham chiếu giao dịch là mã id_order vừa tạo
                $vnp_OrderInfo = "Thanh toán đơn hàng Apple Store"; // gán nội dung thanh toán
                $vnp_Amount = $totalPriceNumeric * 25000 * 100; // nếuu số tiền > 100000 thì quy đổi ra USD sau đó nhân với 25000 
                if ($totalPriceNumeric > 100000) {
                     $vnp_Amount = $totalPriceNumeric * 100;
                }
                $vnp_Locale = 'vn';//ngôn ngũ hiển thị Tiếng việt
                $vnp_IpAddr = $request->ip();//Lấy địa chỉ IP mạng của người mua hàng để lưu vết giao dịch

                $vnp_OrderType = 'billpayment';//Phân loại thanh toán là hóa đơn thanh toán hàng hóa
                $inputData = array( // Tạo mảng thông tin giao dịch
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => route('vnpay-return'),
                    "vnp_TxnRef" => $vnp_TxnRef,
                );

                // sắp xếp các khóa trong mảng theo thứ tự bảng chữ cái để đảm bảo đồng bộ thuật toán tạo chữ ký bảo mật
                ksort($inputData);
                $query = ""; // khởi tạo chuỗi tham số để tạo url truy cập cổng thanh toán của VNpay
                $i = 0;
                $hashdata = ""; // khởi tạo chuỗi dữ liệu để tạo chữ ký bảo mật

                // Vòng lặp duyệt qua mảng dữ liệu đã sắp xếp để nối chúng thành chuỗi truy vấn (HTTP Query) được mã hóa URL (urlencode)
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {// nếu là phần tử thứ 2 trở đi thì thêm dấu & vào trước
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);// 
                    } else {// nếu là phần tử đầu tiên thì không thêm dấu &
                        $hashdata .= urlencode($key) . "=" . urlencode($value);// gán giá trị cho key
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
 
                $vnp_Url = $vnp_Url . "?" . $query; // tạo url truy cập cổng thanh toán của VNpay
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // tạo chữ ký bảo mật bằng thuật toán hash_hmac
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash; // thêm chữ ký bảo mật vào url

                // Only empty the bag if we checked out from the bag (NOT is_direct_buy)
                if (!$isDirectBuy && !$cartItems->isEmpty() && !empty($email)) {
                    CartItem::where('email', $email)->delete();
                }

                return response()->json([
                    'success' => true,
                    'payment_method' => 'VNPAY',
                    'payment_url' => $vnp_Url
                ]);
            }

            // Only empty the bag if we checked out from the bag (NOT is_direct_buy)
            if (!$isDirectBuy && !$cartItems->isEmpty() && !empty($email)) {
                CartItem::where('email', $email)->delete();
            }

            return response()->json([
                'success' => true, 
                'message' => 'Đặt hàng thành công!',
                'order_id' => $orderIds[0]
            ]);
        } catch (\Exception $e) {
            \Log::error('Order Error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
                'user' => session('user_name')
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }

    public function vnpayReturn(Request $request) {
        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $orderId = $request->input('vnp_TxnRef');
        $order = Order::find($orderId);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->input('vnp_ResponseCode') == '00') {
                $order->update([
                    'status' => 'paid',
                    'vnp_transaction_no' => $request->input('vnp_TransactionNo'),
                    'vnp_response_code' => '00'
                ]);
                return redirect('/bag?tab=orders')->with('success', 'Thanh toán VNPay thành công!');
            } else {
                $order->update(['status' => 'failed', 'vnp_response_code' => $request->input('vnp_ResponseCode')]);
                return redirect('/bag?tab=orders')->with('error', 'Thanh toán VNPay không thành công. Mã lỗi: ' . $request->input('vnp_ResponseCode'));
            }
        } else {
            return redirect('/bag?tab=orders')->with('error', 'Chữ ký không hợp lệ!');
        }
    }

    public function vnpayIPN(Request $request) {
        // IPN handles background verification from VNPay server
        $vnp_HashSecret = env('VNP_HASHSECRET');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            $orderId = $request->input('vnp_TxnRef');
            $order = Order::find($orderId);
            if ($order) {
                if ($request->input('vnp_ResponseCode') == '00') {
                    $order->update(['status' => 'paid', 'vnp_transaction_no' => $request->input('vnp_TransactionNo')]);
                } else {
                    $order->update(['status' => 'failed']);
                }
                return response()->json(['RspCode' => '00', 'Message' => 'Confirm Success']);
            }
            return response()->json(['RspCode' => '01', 'Message' => 'Order not found']);
        }
        return response()->json(['RspCode' => '97', 'Message' => 'Invalid signature']);
    }

    public function orderDetail() {
        if (!session()->has('user_name')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
        }
        $orders = Order::where('email', session('email'))->get();
        return view('pages.order-detail', compact('orders'));
    }

    public function deleteOrder(Request $request) {
        if (!session()->has('email')) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập.'], 401);
        }

        $id_order = $request->query('id_order');
        $email = session('email');

        $order = Order::where('id_order', $id_order)->where('email', $email)->first();

        if ($order) {
            $order->delete();
            return response()->json(['success' => true, 'message' => 'Đã xóa đơn hàng thành công.']);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng hoặc bạn không có quyền xóa.'], 404);
    }
}
