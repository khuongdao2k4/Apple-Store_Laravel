<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CartItem;
use App\Models\Order;
use App\Helpers\ColorHelper;

class CartController extends Controller
{
    public function index() {
        if (!session()->has('email')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $email = strtolower(session('email'));
        $cartItems = CartItem::where('email', $email)->paginate(5, ['*'], 'bag_page');
        $orders = Order::where('email', $email)->latest()->paginate(5, ['*'], 'order_page');

        $cartItems->getCollection()->transform(function($item) {
            $item->color = ColorHelper::resolve($item->color);
            return $item;
        });

        $orders->getCollection()->transform(function($order) {
            $order->color = ColorHelper::resolve($order->color);
            return $order;
        });

        return view('pages.bag', compact('cartItems', 'orders'));
    }

    public function add(Request $request) {
        if (!session()->has('email')) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập.'], 401);
        }

        $email = strtolower(session('email'));
        $productName = $request->input('product_name');
        $storage = $request->input('storage');
        $color = ColorHelper::resolve($request->input('color'));

        $applecare = $request->input('applecare') == '1' ? true : false;

        // Check if item already exists in cart for this user
        $item = CartItem::where('email', $email)
            ->where('product_name', $productName)
            ->where('storage', $storage)
            ->where('color', $color)
            ->where('applecare', $applecare)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'email' => $email,
                'product_name' => $productName,
                'price' => $request->input('price'),
                'storage' => $storage,
                'color' => $color,
                'image_url' => $request->input('image_url'),
                'quantity' => 1,
                'applecare' => $applecare,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Đã thêm vào giỏ hàng thành công!']);
    }

    public function updateQuantity(Request $request) {
        $item = CartItem::find($request->input('id'));
        if ($item && $item->email === session('email')) {
            $item->update(['quantity' => $request->input('quantity')]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function remove(Request $request) {
        $item = CartItem::find($request->input('id'));
        if ($item && $item->email === session('email')) {
            $item->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
