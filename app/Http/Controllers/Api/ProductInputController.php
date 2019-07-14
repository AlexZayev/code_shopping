<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Models\ProductInput;
use CodeShopping\Http\Resources\ProductInputResource;
use CodeShopping\Http\Requests\ProductInputRequest as Request;
//use Illuminate\Http\Request;
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
        $input = ProductInput::create($request->all());

        return new ProductInputResource($input);
    }

    public function show(ProductInput $input)
    {
        return new ProductInputResource($input);
    }

}
