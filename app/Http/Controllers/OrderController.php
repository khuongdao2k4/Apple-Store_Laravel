<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;

class OrderController extends Controller
{
    public function order(Request $request) {
        $series = $request->query('series');
        $id = $request->query('id');
        
        if ($series) {
            $products = Product::with('options.attribute')->where('series', $series)->orderBy('sort_order', 'asc')->get();
            if ($products->isEmpty()) {
                return redirect()->route('home')->with('error', 'Không tìm thấy dòng sản phẩm này.');
            }
            return view('pages.order', compact('products'));
        } elseif ($id) {
            $product = Product::with('options.attribute')->find($id);
            if (!$product) {
                return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại.');
            }
            // Fallback for single product id viewing if needed
            $products = collect([$product]);
            return view('pages.order', compact('products'));
        }

        $products = Product::with('options.attribute')->all();
        return view('pages.order', compact('products'));
    }

    public function checkout(Request $request) {
        if (!session()->has('user_name')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $email = session('email');
        $cartItems = CartItem::where('email', $email)->get();

        $isDirectBuy = false;
        // If specific product in query, handle as single item (legacy support / Buy Now)
        if ($request->query('product')) {
            $isDirectBuy = true;
            $item = [
                'product_name' => $request->query('product'),
                'price' => $request->query('price'),
                'storage' => $request->query('storage'),
                'color' => $request->query('color'),
                'image_url' => $request->query('image_url'),
                'quantity' => 1,
                'applecare' => $request->query('applecare') == '1'
            ];
            $cartItems = collect([ (object)$item ]);
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $priceVal = floatval(str_replace(['$', ','], '', $item->price));
            $totalPrice += $priceVal * $item->quantity;
        }

        return view('pages.checkout', compact('cartItems', 'totalPrice', 'isDirectBuy'));
    }

    public function processOrder(Request $request) {
        try {
            if (!session()->has('user_name')) {
                return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập.'], 401);
            }

            $email = session('email');
            $cartItems = CartItem::where('email', $email)->get();
            
            $totalPriceNumeric = 0;
            $orderIds = [];
            
            $isDirectBuy = $request->input('is_direct_buy') == '1';

            if ($isDirectBuy && $request->has('product')) {
                // Handle Direct Buy Flow (Buy Now)
                $priceStr = $request->input('price');
                $priceVal = intval(preg_replace('/[^0-9]/', '', $priceStr));
                $totalPriceNumeric = $priceVal;

                $itemData = [
                    [
                        'product_name' => $request->input('product'),
                        'image_url' => $request->input('image_url'),
                        'storage' => $request->input('storage'),
                        'color' => $request->input('color'),
                        'price' => $priceVal,
                        'quantity' => 1,
                        'applecare' => $request->input('applecare') == '1',
                    ]
                ];

                $order = Order::create([
                    'username' => session('user_name'),
                    'email' => $email,
                    'product' => $request->input('product'),
                    'items' => $itemData,
                    'image_url' => $request->input('image_url'),
                    'storage' => $request->input('storage'),
                    'color' => $request->input('color'),
                    'price' => $priceVal,
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'payment_method' => $request->input('payment_method', 'COD'),
                    'status' => 'pending',
                ]);
                $orderIds[] = $order->id_order;
            } elseif (!$cartItems->isEmpty()) {
                // Handle Normal Bag Checkout - Combine into 1 order
                $productNames = [];
                $firstImageUrl = $cartItems->first()->image_url;
                $storages = [];
                $colors = [];
                $itemData = [];
                
                foreach ($cartItems as $item) {
                    $itemPriceVal = intval(preg_replace('/[^0-9]/', '', $item->price));
                    $totalPriceNumeric += $itemPriceVal * $item->quantity;
                    $productNames[] = $item->product_name . " (x" . $item->quantity . ")";
                    
                    if (!in_array($item->storage, $storages)) $storages[] = $item->storage;
                    if (!in_array($item->color, $colors)) $colors[] = $item->color;

                    $itemData[] = [
                        'product_name' => $item->product_name,
                        'image_url' => $item->image_url,
                        'storage' => $item->storage,
                        'color' => $item->color,
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
                    'storage' => \Illuminate\Support\Str::limit(implode(', ', $storages), 250),
                    'color' => \Illuminate\Support\Str::limit(implode(', ', $colors), 250),
                    'price' => $totalPriceNumeric,
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'payment_method' => $request->input('payment_method', 'COD'),
                    'status' => 'pending',
                ]);
                $orderIds[] = $order->id_order;
            } else {
                return response()->json(['success' => false, 'message' => 'Giỏ hàng trống hoặc thiếu thông tin sản phẩm.'], 400);
            }

            if ($request->input('payment_method') === 'VNPAY') {
                $vnp_Url = env('VNP_URL');
                $vnp_HashSecret = env('VNP_HASHSECRET');
                $vnp_TmnCode = env('VNP_TMNCODE');

                $vnp_TxnRef = $orderIds[0];
                $vnp_OrderInfo = "Thanh toán đơn hàng Apple Store";
                $vnp_Amount = $totalPriceNumeric * 25000 * 100;
                if ($totalPriceNumeric > 100000) {
                     $vnp_Amount = $totalPriceNumeric * 100;
                }
                $vnp_Locale = 'vn';
                $vnp_IpAddr = $request->ip();

                $vnp_OrderType = 'billpayment';
                $inputData = array(
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

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

                // Only empty the bag if we checked out from the bag (NOT is_direct_buy)
                if (!$isDirectBuy && !$cartItems->isEmpty()) {
                    CartItem::where('email', $email)->delete();
                }

                return response()->json([
                    'success' => true,
                    'payment_method' => 'VNPAY',
                    'payment_url' => $vnp_Url
                ]);
            }

            // Only empty the bag if we checked out from the bag (NOT is_direct_buy)
            if (!$isDirectBuy && !$cartItems->isEmpty()) {
                CartItem::where('email', $email)->delete();
            }

            return response()->json([
                'success' => true, 
                'message' => 'Đặt hàng thành công!',
                'order_id' => $orderIds[0]
            ]);
        } catch (\Exception $e) {
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
