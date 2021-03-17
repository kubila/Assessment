<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        $file = Storage::disk('public')->allFiles('images');
        dd($file);
        $product = Product::all();
        return view('welcome', ['data' => Product::all()]);
    }
}
