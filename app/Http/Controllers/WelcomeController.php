<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {

        $product = Product::with('category')->paginate(12);
        return view('welcome', ['data' => $product]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showProduct(Product $product)
    {
        try {

            $product = Product::with('category')->findOrFail($product->id);
        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('products.show', ['data' => $product]);
    }

    /**
     * Display the specified resource
     * @return \Illuminate\Http\Response
     */
    public function showCategories()
    {
        $cats = Category::paginate(10);
        return view('categories.index', ['data' => $cats]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showCategoryProducts(Category $category)
    {
        try {

            $category = Product::with('category')->where('category_id', $category->id)->paginate(15);

        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('show', ['data' => $category]);
    }

}
