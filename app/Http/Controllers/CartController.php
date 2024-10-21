<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\democart;

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
    public function create(Request $request, $productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
        $userId = auth()->id(); // Lấy ID người dùng đã đăng nhập
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
        Cart::create([
            'user_id' =>$userId,
            'product_id' => $productId,
            'quantity' => $request->input('quantity', 1)
        ]);

        return redirect()->route('cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump($carts = Cart::all());
        // die();
        if ($request->ajax()) {
            $carts = Cart::all();
            return response()->json([
                'carts' => $carts->items(),
            ]);
        }
        $carts = Cart::all();
        $viewDatas = [
            'title' => 'Cart Page',
        ];
        return view('home.cart')
            ->with("carts", $carts)
            ->with('viewData', $viewDatas);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::find($id);
        // $viewDatas = [
        //     'title' => 'Cart page',
        // ];
        // return view('home.cart', compact('product'))->with('viewData', $viewDatas);
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
    public function clearCart()
    {
        Cart::truncate(); // hoặc Cart::query()->delete();
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}
