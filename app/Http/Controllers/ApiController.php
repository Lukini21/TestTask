<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Product;

class ApiController extends Controller
{
    public function getProducts(ProductsRequest $request)
    {
        $products = Product::getProducts($request->all());

        return response()->json(['products' => $products]);
    }

    public function getFilters()
    {
        return response()->json(['filters' => Product::getAvailableFilters()]);
    }
}
