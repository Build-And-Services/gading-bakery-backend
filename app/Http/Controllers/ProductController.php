<?php

namespace App\Http\Controllers;

use File;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('stocks', 'stocks.product_id', '=', 'products.id')
                        ->groupBy('products.id', 'products.name')
                        ->select(
                            'products.id',
                            'products.name',
                            'products.product_code',
                            'products.selling_price',
                            'products.purchase_price',
                            'products.image',
                            'categories.name as category',
                            DB::raw("SUM(CASE WHEN stocks.type = 'increase' THEN stocks.quantity ELSE -stocks.quantity END) AS total_stock")
                        )->get();

        $categories = DB::table('categories')->select('id', 'name')->get();

        return Inertia::render('Products/index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:5120',
                'product_code' => 'required|unique:products,product_code',
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
            return redirect(route('product.index'))->with('success','data successfully created');

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id): Response
    {
        $product = Product::with('category','stocks')->findOrFail(intval($id));
        $categories = DB::table('categories')->select('id','name')->get();
        $product['quantity'] = $product->getTotalQuantity();
        // dd($product);
        return Inertia::render('Products/edit', ['product' => $product, 'categories'=> $categories]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::with('stocks')->findOrFail(intval($id));

            $dataToUpdate = [
                'name' => $request->name,
                'product_code' => $request->product_code,
                'purchase_price' => $request->purchase_price,
                'selling_price' => $request->selling_price,
                'category_id' => $request->category_id,
            ];

            $quantity = $product->getTotalQuantity();
            if ($quantity < $request->quantity) {
                Stock::create(['stock'=> $request->quantity-$quantity, 'product_id' => $product->id, 'type' => 'increase']);
            } else if ($quantity > $request->quantity) {
                Stock::create(['quantity'=> $quantity-$request->quantity, 'product_id' => $product->id, 'type' => 'decrease']);
            }

            if ($request->hasFile('image')) {
                $url = $product->image;
                $oldFile = pathinfo($url);
                $oldFilePath = public_path('images/products/' . $oldFile['basename']);

                if ($oldFile && File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }

                $fileName = date('YmdHis') . '-image' . '.' . $request->image->extension();
                $request->image->move(public_path('images/products'), $fileName);
                $dataToUpdate['image'] = url("/images/products/{$fileName}");
            } else{
                $dataToUpdate["image"] = $request->image;
            }

            $product->update($dataToUpdate);
            DB::commit();
            return redirect(route('product.index'))->with('success','data successfully update');
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
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
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('errors', $th->getMessage());
        }
    }
}
