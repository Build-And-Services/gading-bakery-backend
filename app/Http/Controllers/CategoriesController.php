<?php

namespace App\Http\Controllers;

use File;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all()->toArray();
        // $categories = DB::table('categories')->select('id', 'name')->get();
        // dd($categories);

        return Inertia::render('Categories/index', [
            'categories'=> $categories
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'=> 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:5120'
            ]);
            $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $fileName);

            $category = Category::create([
                'name'=> $request->name,
                'image' => url("/images/categories/{$fileName}")
            ]);
            return redirect(route('category.index'))->with('success','data successfully created');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return Inertia::render('Categories/edit', [
                'category'=> $category,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name'=> 'required',
                // 'image'=> 'required|mimes:png,jpg,jpeg|max:5120'
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
            return redirect(route('category.index'))->with('success','data successfully updated');
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
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
            return redirect(route('category.index'))->with('success','data successfully delete');
        } catch (\Throwable $th) {
            return response()->json(['error'=> $th->getMessage()], 500);
        }
    }
}
