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
        $products = Product::all();
        return view('pages.mua-iphone', compact('products')); 
    }
    public function bag() { return view('pages.bag'); }
    
    public function addProduct() { return view('pages.add-product'); }
    public function editProduct() { return view('pages.edit-product'); }
    public function deleteProduct() { return view('pages.delete-product'); }
    public function statistics() { return view('pages.statistics'); }
}
