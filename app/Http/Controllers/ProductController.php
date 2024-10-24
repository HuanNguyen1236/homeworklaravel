<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',         
            'description' => 'required|string|max:1000', 
            'price' => 'required|numeric|min:0',         
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        if ($request->hasFile('avatar')) {
            $fileName = 'product_' . $product->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('img'), $fileName);
            $product->update(['avatar' => 'img/' . $fileName]);
        }
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::paginate(3);
            return response()->json([
                'products' => $products->items(),
                'hasMore' => $products->hasMorePages(),
            ]);
        }
        // $products = Product::all();
        $products = Product::paginate(perPage: 6);
        $viewDatas = [
            'title' => 'Home',
        ];
        return view('home.index')
            ->with("products", $products)
            ->with('viewData', $viewDatas);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
         $viewDatas = [
            'title' => 'Home',
        ];
        return view('home.product-detail', compact('product'))->with('viewData', $viewDatas);
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
