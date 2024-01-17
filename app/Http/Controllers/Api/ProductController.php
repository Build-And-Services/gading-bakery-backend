<?php

namespace App\Http\Controllers\Api;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::latest()->get();
        return $this->sendResponse(ProductResource::collection($products), "Successfully get data", 200);
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:5120',
                'product_code' => 'required',
                'purchase_price' => 'required|integer',
                'selling_price' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'required|integer',
            ]);

            $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $fileName);

            $product = Product::create([
                'name' => $request->name,
                'image' => url("/images/products/{$fileName}"),
                'product_code' => $request->product_code,
                'purchase_price' => $request->purchase_price,
                'selling_price' => $request->selling_price,
                'category_id' => $request->category_id,
            ]);

            $product->stocks()->create([
                'quantity' => $request->quantity,
                'type' => 'increase'
            ]);

            \DB::commit();
            return $this->sendResponse(new ProductResource($product), 'Product created successfully', 201);
        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function show(string $id)
    {
        try {
            $product = Product::find($id);
            return $this->sendResponse(new ProductResource($product), 'Successfully get products', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg|max:5120',
                'product_code' => 'required',
                'purchase_price' => 'required|integer',
                'selling_price' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
            ]);

            $product = Product::findOrFail($id);

            $dataToUpdate = [
                'name' => $request->name,
                'product_code' => $request->product_code,
                'purchase_price' => $request->purchase_price,
                'selling_price' => $request->selling_price,
                'category_id' => $request->category_id,
            ];

            if ($request->hasFile('image')) {
                $url = $product->image;
                $oldFile = pathinfo($url);
                $oldFilePath = public_path('images/products/' . $oldFile['basename']);

                // delete old image
                if ($oldFile && \File::exists($oldFilePath)) {
                    \File::delete($oldFilePath);
                }

                $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
                $request->image->move(public_path('images/products'), $fileName);
                $dataToUpdate['image'] = url("/images/products/{$fileName}");
            }

            $product->update($dataToUpdate);
            return $this->sendResponse(new ProductResource($product), 'Successfully updated product', 202);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $url = $product->image;
            $fileName = pathinfo($url);
            $path = public_path('images/products/' . $fileName['basename']);

            if ($fileName && \File::exists($path)) {
                \File::delete($path);
            }

            $product->delete();
            return $this->sendResponse(new ProductResource($product), 'Successfully deleted product', 203);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
