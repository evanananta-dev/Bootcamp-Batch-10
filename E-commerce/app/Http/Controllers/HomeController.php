<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::paginate(2);
        return view ('home', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }
}
