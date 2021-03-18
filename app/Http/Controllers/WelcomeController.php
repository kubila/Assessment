<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {

        $product = Product::with('category')->paginate(12);
        return view('welcome', ['data' => $product]);
    }

    public function showProduct(Product $product)
    {

    }

    public function showCategories(Category $category)
    {

    }

}
