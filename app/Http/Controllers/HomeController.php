<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        session()->put('page-title','Home');
        $products = Product::all();
        return view('home', compact('products'));
    }
}
