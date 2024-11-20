<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use PhpParser\Node\Stmt\UseUse;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.home.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home.newproduct');
    }
    public function createProduct()
    {
        return view('admin.home.newproduct');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viewDatas = [
            'title' => 'Edit product',
        ];
        return view('admin.home.updateproduct')->with('viewData', $viewDatas)->with('product', Product::find($id));
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
    public function storeUser(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            return response()->json([
                'users' => $users->items(),
                'hasMore' => $users->hasMorePages(),
            ]);
        }
        return view('admin.home.user')
            ->with("users", User::all());
    }
    public function storeProduct(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::all();
            return response()->json([
                'products' => $products->items(),
                'hasMore' => $products->hasMorePages(),
            ]);
        }
        return view('admin.home.product')
            ->with("products", Product::all());
    }
    public function storeCart(Request $request)
    {
        if ($request->ajax()) {
            $carts = Cart::all();
            return response()->json([
                'carts' => $carts->items(),
                'hasMore' => $carts->hasMorePages(),
            ]);
        }
        return view('admin.home.cart')
            ->with("carts", Cart::all());
    }
}
