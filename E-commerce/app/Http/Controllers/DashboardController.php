<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $JumlahProduk = Product::count();

        $JumlahklikProduk = Product::sum('click');

        $JumlahKategori = ProductCategory::count();

        $JumlahUser = User::count();

        return view('admin.dashboard', compact('JumlahProduk', 'JumlahklikProduk', 'JumlahKategori', 'JumlahUser'));
    }
}
