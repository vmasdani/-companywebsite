<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        return Product::all();
    }

    public function dummy_create()
    {
        $test_ob = (array)[
            'id' => 2,
            'name' => 'Newproductetesting_' . (string)rand(),
            'description' => 'mydescription_' . (string)rand(),
            'price_idr' => 50000.0 + rand()
        ];

        // var_dump($test_ob);
        // return;

        // var_dump($test_ob['id']);
        // var_dump(json_decode(json_encode(new Product($test_ob)), true));
        // var_dump(json_encode(new Product($test_ob)));
        // return;


        // return Product::updateOrCreate(['id' => 2], [json_decode(json_encode(new Product($test_ob)), true)]);
        return Product::updateOrCreate(['id' => null], json_decode(json_encode(new Product($test_ob)), true));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
