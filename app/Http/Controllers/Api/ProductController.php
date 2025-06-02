<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $products,
        ]);
    }

    public function showByBarcode($barcode)
    {
        $product = Product::where('barcode', $barcode)->first();

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $product,
        ]);
    }
}
