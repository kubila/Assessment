<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
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
        $cart = Product::with('cart'); //->with('products');
        dd($cart);
        return view('cart.manage_cart', ['data' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);

        $product = Product::all()->where('id', $request->id)->first();
        $cart = Cart::all()->where('product_id', $product->id)->first();

        if (isset($cart->product_id) && $product->id == $cart->product_id) {

            try {

                $cart->update([
                    'quantity' => $cart->quantity + 1,
                    'total' => $cart->total + $product->price,
                ]);

            } catch (\Exception $th) {

                Log::error($th->getMessage());
                return response()->json(['error' => 'Cart couldn\'t be updated.']);
            }

            return response()->json(['success' => 'Cart updated.']);

        } else {

            try {

                Cart::create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'total' => $product->price,
                ]);

            } catch (\Exception $th) {
                Log::error($th->getMessage());
                return response()->json(['error' => 'Can\'t add to cart.']);
            }

            return response()->json(['success' => 'Added to cart.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
