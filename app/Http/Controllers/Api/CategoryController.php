<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class CategoryController extends BaseController
{
    public function index()
    {
        try {
            $categories = Category::with('product')->get();
            return $this->sendResponse(CategoryResource::collection($categories), "Successfully get data", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $categories = Category::create([
                'name' => $request->name,
            ]);
            return $this->sendResponse(new CategoryResource($categories), 'Categories created successfully', 201);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $categories = Category::findOrFail($id);

            $dataToUpdate = [
                'name' => $request->name,
            ];

            $categories->update($dataToUpdate);
            return $this->sendResponse(new CategoryResource($categories), 'Successfully updated category', 202);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            $categories = Category::findOrFail($id);
            $categories->delete();
            return $this->sendResponse(new CategoryResource($categories), 'Successfully deleted category', 203);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
