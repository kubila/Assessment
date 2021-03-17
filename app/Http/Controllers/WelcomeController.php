<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('welcome', ['data' => Product::all()]);
    }
}
