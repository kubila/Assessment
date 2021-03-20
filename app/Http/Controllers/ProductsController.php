<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('view-products')) {
            abort(403);
        }

        $products = Product::with('category')->paginate(10);
        return view('products.index', ['data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-products')) {
            abort(403);
        }
        $cats = Category::all('id', 'name');
        return view('products.add', ['cats' => $cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        if (Gate::denies('manage-products')) {
            abort(403);
        }

        $image = Storage::disk('public')->put('images', $request->image);

        try {
            Product::create([
                'productName' => $request->productName,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $image,
                'category_id' => $request->category_id,
            ]);

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return back()->with(['error' => 'An error occurred while trying to create product.']);
        }

        return redirect()->route('products.index')->with(['success' => 'Product created successfully.']);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (Gate::denies('view-products')) {
            abort(403);
        }
        //$product = Product::with('category')->where('id', $product->id)->first();
        try {

            $product = Product::with('category')->findOrFail($product->id);

        } catch (\Exception $th) {

            Log::error($th->getMessage());
            return back()->with(['error' => 'Not found.']);

        }
        return view('products.show', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //$product = Product::with('category')->where('id', $product->id)->first();
        if (Gate::denies('manage-products')) {
            abort(403);
        }

        $cats = Category::all('id', 'name'); //->whereNotIn('id', [$product->category_id]);

        return view('products.edit', compact('product', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if (Gate::denies('manage-products')) {
            abort(403);
        }

        $data = $request->only(['productName', 'price', 'description', 'category_id']);

        // check if request has a file
        if ($request->hasFile('image')) {
            $image = Storage::disk('public')->put('images', $request->image);
            Storage::disk('public')->delete('images', $product->image);
            $data['image'] = $image;
        }

        try {

            $product->update($data);

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return back()->with(['error' => 'An error occurred while trying to update the product.']);
        }

        return redirect()->route('products.index')->with(['success' => 'Product updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Gate::denies('manage-products')) {
            abort(403);
        }
        try {
            Storage::disk('public')->delete('images', $product->image);
            $product->category()->dissociate();
            $product->destroy($product->id);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Couldn\'t delete the product.'], 400);
        }

        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
