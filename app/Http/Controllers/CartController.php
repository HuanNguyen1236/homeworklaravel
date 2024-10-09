<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewDatas = [
            'title' => 'Cart page',
        ];
        return view ('home.cart')->with('viewData', $viewDatas);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $id)
    {
        // var_dump($id, $request->quantity);
        // die();
        $product = Product::find($id);
        Cart::create([
            'user_id' => '2',
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        return redirect()->route('cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $viewDatas = [
            'title' => 'Cart page',
        ];
        return view('home.product-detail', compact('product'))->with('viewData', $viewDatas);;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
