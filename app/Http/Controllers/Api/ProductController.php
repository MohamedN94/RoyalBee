<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Product;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::find($id);
        return api_response(new ProductResource($product), 'List of products', 1);
    }
}
