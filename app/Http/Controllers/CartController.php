<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if (Gate::denies('manage-cart')) {
            abort(403);
        }

        return view('cart.manage_cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upsert(Request $request)
    {
        if (Gate::denies('manage-cart')) {
            abort(403);
        }

        $request->validate([
            'id' => 'required|numeric',
        ]);

        try {
            $product = Product::find($request->id);

            //$userId = DB::table('shoppingcart')->where('identifier', auth()->user()->id)->pluck('identifier')->first();

            Cart::add(['id' => $product->id, 'name' => $product->productName, 'qty' => 1, 'price' => $product->price, 'weight' => 1])->associate($product);

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Can\'t add to cart.']);
        }

        return response()->json(['success' => 'Added to cart.']);

    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if (Gate::denies('manage-cart')) {
            abort(403);
        }

        $request->validate([
            'id' => 'required',
        ]);

        try {

            Cart::remove($request->id);

        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Couldn\'t delete from the cart.'], 400);
        }

        return response()->json(['success' => 'Product deleted from the cart.']);

    }
}
