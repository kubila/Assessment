<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            $userId = DB::table('shoppingcart')->where('identifier', auth()->user()->id)->pluck('identifier')->first();

            if ($userId != null) {

                // if user id is not null then there is an instance, add to it,
                // if the product is aldready in cart, update quantity
                // and associate with the product model
                // cart content will be destroyed when the user logged out.
                \Cart::add(['id' => $product->id, 'name' => $product->productName, 'qty' => 1, 'price' => $product->price, 'weight' => 1])->associate($product);

            } else {

                // if user is null then there is no instance, create one with name of shopping and add to it,
                // if the product is aldready in cart, update quantity
                // and associate with product model
                // cart content will be destroyed when the user logged out.

                \Cart::instance('shopping')->store(auth()->user()->id);
                \Cart::add(['id' => $product->id, 'name' => $product->productName, 'qty' => 1, 'price' => $product->price, 'weight' => 1])->associate($product);

            }
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return response()->json(['error' => 'Can\'t add to cart.']);
        }

        return response()->json(['success' => 'Added to cart.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if (Gate::denies('manage-cart')) {
            abort(403);
        }

    }
}
