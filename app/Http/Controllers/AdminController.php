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
        $products = Product::all();
        $accounts = User::all();
        $carts = Cart::all();
        $viewData = [
            'title'=>'Admin Dashboard',
        ];

        return view('admin.adminpanel', compact('products', 'accounts', 'carts'))->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function storeUser(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            return response()->json([
                'users' => $users->items(),
                'hasMore' => $users->hasMorePages(),
            ]);
        }
        // $products = Product::all();
        $users = User::all();
        return view('admin.home.user')
            ->with("users", $users);
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
        $products = Product::all();
        return view('admin.home.product')
            ->with("products", $products);
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
        $carts = Cart::all();
        return view('admin.home.cart')
            ->with("carts", $carts);
    }
}
