<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class WelcomeController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function homeProducts(Request $request)
    {
        // if ($cached = Redis::get('products.all')) {
        //     $cachedProducts = json_decode($cached);
        //     //dd($cachedProducts);
        //     return view('welcome', ['data' => $cachedProducts]);
        // }

        $page = $request->has('page') ? $request->query('page') : 1;
        $cache = Cache::remember('products.all_page_' . $page, now()->addDay(), function () {
            return Product::with('category')->paginate(12);
        });
        //Redis::setex('products.all', 60 * 60, $products);

        return view('welcome', ['data' => $cache]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showProduct(Product $product)
    {
        try {

            $cache = Cache::remember('products.single_' . $product->id, now()->addMinutes(720), function () use ($product) {

                return Product::with('category')->findOrFail($product->id);

            });

        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('products.show', ['data' => $cache]);
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showCategories(Request $request)
    {

        $page = $request->has('page') ? $request->query('page') : 1;
        $cache = Cache::remember('categories.all_page_' . $page, now()->addDay(), function () {
            return Category::paginate(10);

        });

        return view('categories.index', ['data' => $cache]);
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showCategoryProducts(Category $category, Request $request)
    {
        try {

            $page = $request->has('page') ? $request->query('page') : 1;
            $cache = Cache::remember('categories.single.products_all_' . $category->id . '_page_' . $page, now()->addMinutes(720), function () use ($category) {
                return Product::with('category')->where('category_id', $category->id)->paginate(15);

            });

        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('show', ['data' => $cache]);
    }

}
