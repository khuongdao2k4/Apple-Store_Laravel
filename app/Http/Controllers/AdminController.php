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
        // Total Revenue (all paid orders)
        $orders = Order::all();
        $totalRevenue = 0;
        foreach ($orders as $order) {
            if ($order->status === 'paid' || $order->status === 'shipped' || $order->status === 'completed') {
                $numericPrice = floatval(preg_replace('/[^0-9]/', '', $order->price));
                $totalRevenue += $numericPrice;
            }
        }

        // Stats
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $productsCount = Product::count();
        $usersCount = User::count();

        // Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

        return view('pages.admin.dashboard', compact(
            'totalRevenue', 
            'pendingOrdersCount', 
            'productsCount', 
            'usersCount',
            'recentOrders'
        ));
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.orders', compact('orders'));
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

    public function products()
    {
        $products = Product::paginate(10);
        return view('pages.admin.products', compact('products'));
    }

    public function addProduct()
    {
        return view('pages.admin.add-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image_url' => 'required',
            'quantity' => 'required|integer'
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update($request->all());
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
        $year = $request->query('year', date('Y'));

        $orders = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereIn('status', ['paid', 'shipped', 'completed'])
            ->get();

        $totalRevenue = 0;
        foreach ($orders as $order) {
            $totalRevenue += floatval(preg_replace('/[^0-9]/', '', $order->price));
        }

        return view('pages.admin.statistics', compact('orders', 'totalRevenue', 'month', 'year'));
    }
}
