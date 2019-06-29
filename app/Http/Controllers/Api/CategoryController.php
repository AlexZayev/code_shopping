<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Resources\CategoryResource;
use CodeShopping\Http\Requests\CategoryRequest;
use CodeShopping\Models\Category;
//use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        $category->refresh();
        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        //outra forma de fazer
        //return response([],204);
        new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([], 204);
    }
}
