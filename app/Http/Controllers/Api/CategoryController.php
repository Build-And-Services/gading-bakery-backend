<?php

namespace App\Http\Controllers\Api;

use File;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                'image' => 'required|image|mimes:png,jpg,jpeg|max:5120'
            ]);

            $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $fileName);

            $categories = Category::create([
                'name' => $request->name,
                'image' => url("/images/categories/{$fileName}")
            ]);
            return $this->sendResponse(new CategoryResource($categories), 'Categories created successfully', 201);
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
            ]);

            $dataToUpdate = [
                'name' => $request->name,
            ];

            $categories = Category::findOrFail($id);

            if ($request->hasFile('image')) {
                $url = $categories->image;
                $oldFile = pathinfo($url);
                $oldFilePath = public_path('images/categories/' . $oldFile['basename']);

                if ($oldFile && File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }

                $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
                $request->image->move(public_path('images/categories'), $fileName);
                $dataToUpdate['image'] = url("/images/categories/{$fileName}");
            }

            $categories->update($dataToUpdate);
            return $this->sendResponse(new CategoryResource($categories), 'Successfully updated category', 202);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function destroy($id)
    {
        try {
            $categories = Category::findOrFail($id);

            $url = $categories->image;
            $fileName = pathinfo($url);
            $path = public_path('images/categories/' . $fileName['basename']);

            if ($fileName && File::exists($path)) {
                File::delete($path);
            }


            $categories->delete();
            return $this->sendResponse(new CategoryResource($categories), 'Successfully deleted category', 203);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
