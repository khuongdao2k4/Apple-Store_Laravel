<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Revenue (all paid/shipped/completed orders)
        $allPaidOrders = Order::whereIn('status', ['paid', 'shipped', 'completed'])->get();
        $totalRevenue = $allPaidOrders->sum(fn($o) => floatval(preg_replace('/[^0-9]/', '', $o->price)));

        // Stats
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $productsCount = Product::count();
        $usersCount = User::count();

        // Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

        // Top Selling Products (current month)
        $currentMonth = date('m');
        $currentYear  = date('Y');
        $monthOrders = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->whereIn('status', ['paid', 'shipped', 'completed'])
            ->get();

        $productSales = [];
        foreach ($monthOrders as $order) {
            $name = $order->product ?? 'Không rõ';
            if (!isset($productSales[$name])) {
                $productSales[$name] = ['count' => 0, 'revenue' => 0];
            }
            $productSales[$name]['count']++;
            $productSales[$name]['revenue'] += floatval(preg_replace('/[^0-9]/', '', $order->price));
        }
        arsort($productSales);
        $topProducts = array_slice($productSales, 0, 10, true);

        // Monthly revenue chart: last 6 months
        $monthlyChartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $m = $date->format('m');
            $y = $date->format('Y');
            $revenue = Order::whereMonth('created_at', $m)
                ->whereYear('created_at', $y)
                ->whereIn('status', ['paid', 'shipped', 'completed'])
                ->get()
                ->sum(fn($o) => floatval(preg_replace('/[^0-9]/', '', $o->price)));
            $monthlyChartData[] = [
                'label' => $date->format('M Y'),
                'value' => $revenue,
            ];
        }

        // Revenue by Series (Pie Chart Data)
        $seriesRevenue = [];
        foreach ($allPaidOrders as $order) {
            $series = $order->series ?? 'Khác';
            if (!isset($seriesRevenue[$series])) $seriesRevenue[$series] = 0;
            $seriesRevenue[$series] += floatval(preg_replace('/[^0-9]/', '', $order->price));
        }
        arsort($seriesRevenue);

        // Payment Method Distribution
        $paymentMethods = Order::select('payment_method', DB::raw('count(*) as count'))
                               ->groupBy('payment_method')
                               ->get();

        // Today's Stats
        $todayOrders = Order::whereDate('created_at', now()->toDateString())->get();
        $ordersTodayCount = $todayOrders->count();
        $revenueToday = $todayOrders->whereIn('status', ['paid', 'shipped', 'completed'])
                                    ->sum(fn($o) => floatval(preg_replace('/[^0-9]/', '', $o->price)));

        // Low Stock Products
        $lowStockProducts = Product::where('quantity', '<', 20)->orderBy('quantity', 'asc')->take(5)->get();

        return view('pages.admin.dashboard', compact(
            'totalRevenue',
            'pendingOrdersCount',
            'productsCount',
            'usersCount',
            'recentOrders',
            'topProducts',
            'monthlyChartData',
            'ordersTodayCount',
            'revenueToday',
            'lowStockProducts',
            'seriesRevenue',
            'paymentMethods'
        ));
    }

    public function orders(Request $request)
    {
        $query = Order::orderBy('created_at', 'desc');

        // Default to current month if no dates provided
        if (!$request->filled('date_from') && !$request->filled('date_to') && !$request->filled('search')) {
            $request->merge([
                'date_from' => now()->startOfMonth()->format('Y-m-d'),
                'date_to' => now()->format('Y-m-d')
            ]);
        }


        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('username', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('product', 'like', "%$s%")
                  ->orWhere('id_order', 'like', "%$s%");
            });
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();
        return view('pages.admin.orders', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.admin.order-detail', compact('order'));
    }

    public function updateOrderStatus(Request $request)
    {
        $order = Order::find($request->id_order);
        if ($order) {
            $order->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
        }
        return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng.'], 404);
    }

    public function products(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('id', 'like', "%$s%")
                  ->orWhere('series', 'like', "%$s%")
                  ->orWhere('series_title', 'like', "%$s%");
            });
        }

        $products = $query->paginate(15)->withQueryString();
        return view('pages.admin.products', compact('products'));
    }

    public function addProduct()
    {
        $existingSeries = Product::select('series', 'series_title', 'series_image')
            ->get()
            ->unique('series')
            ->values();

        $attributes = \App\Models\Attribute::all();

        return view('pages.admin.add-product', compact('existingSeries', 'attributes'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
            'image_url' => 'required|url',
            'quantity' => 'required|integer|min:0'
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'name.min' => 'Tên sản phẩm phải có tối thiểu 3 ký tự.',
            'price.required' => 'Giá bán không được bỏ trống.',
            'image_url.required' => 'Đường dẫn ảnh sản phẩm không được bỏ trống.',
            'image_url.url' => 'Đường dẫn ảnh sản phẩm phải là một URL hợp lệ.',
            'quantity.required' => 'Số lượng kho không được bỏ trống.',
            'quantity.integer' => 'Số lượng kho phải là số nguyên.',
            'quantity.min' => 'Số lượng kho không được nhỏ hơn 0.'
        ]);

        $product = Product::create($request->all());

        // Sync Options
        if ($request->has('options')) {
            foreach ($request->input('options') as $index => $optionData) {
                if (!empty($optionData['label'])) {
                    $product->options()->create([
                        'attribute_id' => $optionData['attribute_id'],
                        'label' => $optionData['label'],
                        'sub_label' => $optionData['sub_label'] ?? null,
                        'price_offset' => $optionData['price_offset'] ?? 0,
                        'description' => $optionData['description'] ?? null,
                        'is_default' => ($optionData['is_default'] ?? '0') == '1',
                        'sort_order' => $index + 1
                    ]);
                }
            }
        }

        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function editProduct($id)
    {
        $product = Product::with(['options' => function($query) {
            $query->join('attributes', 'product_options.attribute_id', '=', 'attributes.id')
                  ->orderByRaw("CASE 
                        WHEN attributes.name LIKE '%Chip%' THEN 1
                        WHEN attributes.name LIKE '%Bộ nhớ%' OR attributes.name LIKE '%RAM%' THEN 2
                        WHEN attributes.name LIKE '%Ổ cứng%' OR attributes.name LIKE '%SSD%' OR attributes.name LIKE '%Dung lượng%' THEN 3
                        WHEN attributes.name LIKE '%Màn hình%' THEN 4
                        WHEN attributes.name LIKE '%Card%' OR attributes.name LIKE '%Đồ họa%' THEN 5
                        WHEN attributes.name LIKE '%Ethernet%' THEN 6
                        WHEN attributes.name LIKE '%Bộ tiếp hợp%' OR attributes.name LIKE '%Nguồn%' THEN 7
                        WHEN attributes.name LIKE '%Bàn phím%' THEN 8
                        WHEN attributes.name LIKE '%Chuột%' OR attributes.name LIKE '%Trackpad%' THEN 9
                        ELSE 20 END")
                  ->orderBy('product_options.sort_order')
                  ->select('product_options.*');
        }, 'options.attribute'])->findOrFail($id);
        
        // Filter attributes based on product series
        $category = 'iphone';
        if (str_contains(strtolower($product->series), 'mac')) {
            $category = 'mac';
        }
        
        $attributes = \App\Models\Attribute::where(function($q) use ($category) {
            $q->where('category', $category)->orWhereNull('category');
        })->get();

        $existingSeries = Product::select('series', 'series_title', 'series_image')
            ->get()
            ->unique('series')
            ->values();
        return view('pages.admin.edit-product', compact('product', 'existingSeries', 'attributes'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required',
            'image_url' => 'required|url',
            'quantity' => 'required|integer|min:0'
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'name.min' => 'Tên sản phẩm phải có tối thiểu 3 ký tự.',
            'price.required' => 'Giá bán không được bỏ trống.',
            'image_url.required' => 'Đường dẫn ảnh sản phẩm không được bỏ trống.',
            'image_url.url' => 'Đường dẫn ảnh sản phẩm phải là một URL hợp lệ.',
            'quantity.required' => 'Số lượng kho không được bỏ trống.',
            'quantity.integer' => 'Số lượng kho phải là số nguyên.',
            'quantity.min' => 'Số lượng kho không được nhỏ hơn 0.'
        ]);

        $product = Product::findOrFail($id);
        
        // Use only fillable fields for product update
        $product->update($request->only([
            'name', 'series', 'series_title', 'series_image', 
            'image_url', 'colors', 'price', 'quantity', 'sort_order'
        ]));
        
        // Sync Options
        if ($request->has('options')) {
            $product->options()->delete();
            foreach ($request->input('options') as $index => $optionData) {
                if (!empty($optionData['label'])) {
                    $product->options()->create([
                        'attribute_id' => $optionData['attribute_id'],
                        'label' => $optionData['label'],
                        'sub_label' => $optionData['sub_label'] ?? null,
                        'price_offset' => $optionData['price_offset'] ?? 0,
                        'description' => $optionData['description'] ?? null,
                        'is_default' => ($optionData['is_default'] ?? '0') == '1',
                        'sort_order' => $index + 1
                    ]);
                }
            }
        }

        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được xóa thành công!');
    }

    public function statistics(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year  = $request->query('year', date('Y'));

        $orders = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereIn('status', ['paid', 'shipped', 'completed'])
            ->get();

        $totalRevenue = $orders->sum(fn($o) => floatval(preg_replace('/[^0-9]/', '', $o->price)));

        // Chart 1: Daily revenue
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);
        $dailyData = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dayRevenue = $orders->filter(fn($o) => $o->created_at->day === $d)
                ->sum(fn($o) => floatval(preg_replace('/[^0-9]/', '', $o->price)));
            $dailyData[] = ['day' => $d, 'value' => $dayRevenue];
        }

        // Chart 2: Revenue by product
        $productRevenue = [];
        foreach ($orders as $order) {
            $name = $order->product ?? 'Khác';
            $shortName = strlen($name) > 30 ? substr($name, 0, 28).'…' : $name;
            if (!isset($productRevenue[$shortName])) $productRevenue[$shortName] = 0;
            $productRevenue[$shortName] += floatval(preg_replace('/[^0-9]/', '', $order->price));
        }
        arsort($productRevenue);
        $productChartData = array_slice($productRevenue, 0, 8, true);

        return view('pages.admin.statistics', compact(
            'orders', 'totalRevenue', 'month', 'year',
            'dailyData', 'productChartData'
        ));
    }

    public function applecare(Request $request)
    {
        // Default to current month if no dates provided
        if (!$request->filled('date_from') && !$request->filled('date_to') && !$request->filled('search')) {
            $request->merge([
                'date_from' => now()->startOfMonth()->format('Y-m-d'),
                'date_to' => now()->format('Y-m-d')
            ]);
        }

        $query = Order::whereIn('status', ['paid', 'shipped', 'completed'])
                      ->orderBy('created_at', 'desc');


        // Only orders that have AppleCare — check items JSON for applecare:true or 1
        $query->where(function($q) {
            $q->where('items', 'like', '%"applecare":true%')
              ->orWhere('items', 'like', '%"applecare":1%')
              ->orWhere('items', 'like', '%"applecare":"1"%')
              ->orWhere('product', 'like', '%AppleCare%');
        });

        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('username', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('product', 'like', "%$s%")
                  ->orWhere('id_order', 'like', "%$s%");
            });
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->paginate(15)->withQueryString();
        $totalCount = $query->count();

        return view('pages.admin.applecare', compact('orders', 'totalCount'));
    }
}
