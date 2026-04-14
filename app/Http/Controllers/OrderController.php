<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function order() {
        $products = Product::all();
        return view('pages.order', compact('products'));
    }

    public function processOrder(Request $request) {
        if (!session()->has('user_name')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        // Logic mapped roughly from legacy process-order.php
        $order = Order::create([
            'username' => session('user_name'),
            'email' => session('email'),
            'product' => $request->input('product', 'Sản phẩm Apple'),
            'image_url' => $request->input('image_url', 'public/assets/img/default.jpg'),
            'storage' => $request->input('storage', '128GB'),
            'color' => $request->input('color', 'Mặc định'),
            'price' => $request->input('price', 0),
        ]);

        return redirect()->route('order-detail')->with('success', 'Thanh toán thành công!');
    }

    public function orderDetail() {
        if (!session()->has('user_name')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
        }
        $orders = Order::where('email', session('email'))->get();
        return view('pages.order-detail', compact('orders'));
    }
}
