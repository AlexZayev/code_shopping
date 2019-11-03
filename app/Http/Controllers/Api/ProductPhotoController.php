<?php
declare(strict_types=1);
namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Resources\ProductPhotoCollection;
use CodeShopping\Http\Resources\ProductPhotoResource;
use CodeShopping\Http\Requests\ProductPhotoRequest as Request;
use CodeShopping\Models\Product;
use CodeShopping\Models\ProductPhoto;
//use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;

class ProductPhotoController extends Controller
{
    public function index(Product $product)
    {
        return new ProductPhotoCollection($product->photos, $product);
    }

    public function store(Request $request, Product $product)
    {
        $photos = ProductPhoto::createWithPhotosFiles($product->id, $request->photos);
        return response()->json(new ProductPhotoCollection($photos, $product), 201);
    }

    public function show(Product $product, ProductPhoto $photo)
    {
        $this->assertProductPhoto($product, $photo);
        return new ProductPhotoResource($photo);
    }

    public function update(Request $request, Product $product, ProductPhoto $photo)
    {
        $this->assertProductPhoto($product, $photo);
        $photo = $photo->updateWithPhoto($request->photo);
        return new ProductPhotoResource($photo);
    }

    public function destroy(Product $product, ProductPhoto $photo)
    {
        $this->assertProductPhoto($product, $photo);
        $photo->deleteWithPhoto();
        return response()->json([], 204);
    }

    private function assertProductPhoto(Product $product, ProductPhoto $photo)
    {
        if($photo->product_id != $product->id){
            abort(404);
        }
    }
}
