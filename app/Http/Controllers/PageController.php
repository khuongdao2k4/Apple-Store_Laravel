<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function home() { return view('pages.home'); }
    public function mac() { return view('pages.mac'); }
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
}
