<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Models\ProductOutput;
use CodeShopping\Http\Resources\ProductOutputResource;
use CodeShopping\Http\Requests\ProductInputRequest as Request;
//use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;

class ProductOutputController extends Controller
{
    public function index()
    {
        $outputs = ProductOutput::with('product')->paginate(); //eager loading | lazy loading
        return ProductOutputResource::collection($outputs);
    }

    public function store(Request $request)
    {
        $output = ProductOutput::create($request->all());
        return new ProductOutputResource($output);
    }

    public function show(ProductOutput $output)
    {
        return new ProductOutputResource($output);
    }
}
