<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Trang chu - Online Store";
        return view('home.index')->with("viewData", $viewData);
    }

    public function about()
    {
        $data1 = "Gioi thieu - Online Store";
        $data2 = "Gioi thieu";
        $description = "Day la trang gioi thieu!";
        $author = "Phat trien boi: OnlyU.";
        return view('home.about')
            ->with("title", $data1)
            ->with("subtitle", $data2)
            ->with("description", $description)
            ->with("author", $author);
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
    public function show()
    {
        $data1 = "Gioi thieu - Online Store";
        $data2 = "NAME PRODUCT";
        $detail = "Detail for Product";
        $price = "Price for product.";
        return view('home.product-detail')
            ->with("title", $data1)
            ->with("subtitle", $data2)
            ->with("description", $detail)
            ->with("author", $price);
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
