<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function home() { return view('pages.home'); }
    public function mac() { return view('pages.mac'); }
    public function muaMac() {
        // Lấy danh sách sản phẩm đại diện cho mỗi dòng để hiển thị ở Landing Page
        $products = Product::where('series', 'like', 'mac%')
            ->orderBy('sort_order', 'asc')
            ->get();
            
        return view('pages.mua-mac', compact('products'));
    }

    public function configMac($id) {
        $product = Product::findOrFail($id);
        $groupedProducts = Product::where('series', $product->series)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('series');
            
        return view('pages.config-mac', compact('product', 'groupedProducts'));
    }
    public function store() { return view('pages.store'); }
    public function muaIphone() { 
        // Group products by series and order by sort_order
        $groupedProducts = Product::orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('series');
            
        return view('pages.mua-iphone', compact('groupedProducts')); 
    }
    public function bag() {
        $orders = [];
        if (session()->has('email')) {
            $orders = \App\Models\Order::where('email', session('email'))->get();
        }
        return view('pages.bag', compact('orders')); 
    }
    
    public function addProduct() { return view('pages.add-product'); }
    public function editProduct() { return view('pages.edit-product'); }
    public function deleteProduct() { return view('pages.delete-product'); }
    public function statistics() { return view('pages.statistics'); }

    public function search(Request $request) {
        try {
            $query = $request->query('query', '');
            if (empty($query)) {
                return response()->json([]);
            }

            $products = \DB::table('products')
                ->where('name', 'LIKE', "%{$query}%")
                ->orderBy('name', 'asc')
                ->limit(10)
                ->get();

            // Format results for the frontend
            $formattedProducts = $products->map(function ($product) {
                $imageUrl = $product->image_url;
                if (!preg_match('/^https?:\/\//', $imageUrl)) {
                    // Normalize path: remove public/ prefix if it exists
                    $path = ltrim($imageUrl, '/');
                    if (str_starts_with($path, 'public/')) {
                        $path = substr($path, 7);
                    }
                    $imageUrl = asset($path);
                }
                
                // Sanitize price to ensure it's a number
                $price = $product->price;
                if (is_string($price)) {
                    $price = (int)preg_replace('/[^0-9]/', '', $price);
                }
                
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $price,
                    'image_url' => $imageUrl
                ];
            });

            return response()->json($formattedProducts);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
