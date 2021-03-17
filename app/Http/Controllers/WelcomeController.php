<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {

        $product = Product::with('category')->paginate(15);
        return view('welcome', ['data' => $product]);
    }
}
