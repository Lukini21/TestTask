<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getProducts(Request $request)
    {
        $products = Product::getProducts($request->all());

        return response()->json(['products' => $products]);
    }

    public function getFilters()
    {
        return response()->json(['filters' => Product::getAvailableFilters()]);
    }
}
