<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\democart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // create cart with session
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $productsInCart =
                Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities(
                $productsInCart,
                $productsInSession
            );
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["products"] = $productsInCart;
        return view('home.cart')->with("viewData", $viewData);
    }
    public function add(Request $request, $id)
    {
        $products = $request->session()->get("products");
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);
        return redirect()->route('cart.index');
    }
    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
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
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
        Cart::create([
            'user_id' => $userId,
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
        $user = Auth::user();
        if ($request->ajax()) {
            $carts = Cart::where('user_id', $user->id)->get();
            return response()->json([
                'carts' => $carts->toArray(),
            ]);
        }
        $carts = Cart::where('user_id', $user->id)->get();
        $viewDatas = [
            'title' => 'Cart Page',
        ];
        return view('home.cart')
            ->with('carts', $carts)
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
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', 'Cart cleared successfully.');
        }
        return redirect()->back()->with('error', 'Cart not found.');
    }
    public function clearCart()
    {
        Cart::truncate(); // hoặc Cart::query()->delete();
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}
