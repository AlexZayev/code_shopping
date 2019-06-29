<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Models\ProductInput;
use CodeShopping\Http\Resources\ProductInputResource;
use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;

class ProductInputController extends Controller
{
    public function index()
    {
        $inputs = ProductInput::with('product')->paginate(); //eager loading | lazy loading
        return ProductInputResource::collection($inputs);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ProductInput $input)
    {
        return new ProductInputResource($input);
    }

}
