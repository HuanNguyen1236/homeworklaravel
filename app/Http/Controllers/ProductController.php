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
            'items' => $request->description,
        ]);

        // Cập nhật đúng cột 'image' thay vì 'avatar'
        if ($request->hasFile('avatar')) {
            $fileName = 'product_' . $product->id . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('img'), $fileName);
            $product->update(['image' => 'img/' . $fileName]); // Sửa 'avatar' thành 'image'
        }

        return redirect()->route('listProduct')->with('success', 'Product created successfully!');
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
        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        try {
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }
                $fileName = 'product_' . $product->id . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('img'), $fileName);
                $product->update(['image' => 'img/' . $fileName]);
            }
            $product->save();
            return redirect()->route('listProduct', ['id' => $product->id])->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('listProduct', ['id' => $product->id])->with('error', 'There was an error updating your profile.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
