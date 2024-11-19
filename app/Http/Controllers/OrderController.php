<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\AccountUser;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $viewData = [];
        $viewData["title"] = "Order - Online Store";
        $viewData["subtitle"] = "Shopping Order";
        if ($request->ajax()) {
            $order = Order::where('user_id', $user->id)->get();
            return response()->json([
                'carts' => $order->toArray(),
            ]);
        }
        $orders = Order::where('user_id', $user->id)->get();
        return view('home.order')
            ->with('orders', $orders)
            ->with('viewData', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Order::validate($request);
        $order = Order::create([
            'total' => $request->total,
            'user_id' => $request->user_id,
        ]);
        $products = $request->session()->get('products', []);

        if (empty($products)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống. Không thể tạo đơn hàng.');
        }
        foreach ($products as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }
        }
        $request->session()->forget('products');
        return redirect()->route('order')->with('success', 'Order created successfully with details!');
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
    public function show(Request $request, string $id)
    {
        $user = Auth::user();  
        $viewData = [];
        $viewData["title"] = "Order - Online Store";
        $viewData["subtitle"] = "Shopping Order Detail";
        $orderdetails = Item::where('order_id', $id)->get();
        return view('home.orderdetail')
            ->with('orderdetails', $orderdetails)
            ->with('viewData', $viewData);
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
