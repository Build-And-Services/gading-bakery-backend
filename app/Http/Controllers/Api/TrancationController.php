<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\TransactionResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class TrancationController extends BaseController
{
    public function index()
    {
        try {
            $transaksi = Order::orderBy('created_at', 'desc')->get();
            return $this->sendResponse(TransactionResource::collection($transaksi), "Successfully get data", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());
            $request->validate([
                "user_id" => ['required'],
                "nominal" => ['required'],
                "order_items" => ['required', 'array', 'min:1'],
                "order_items.*.product_id" => ['required', 'exists:products,id'],
                "order_items.*.quantity" => ['required', 'integer', 'min:1']
            ]);
            $order = Order::create([
                "user_id" => $request->user_id,
                "nominal" => $request->nominal,
            ]);
            $order_items = $request->order_items;
            foreach ($order_items as $order_item) {
                $product = Product::findOrFail($order_item["product_id"]);

                if ($product->getTotalQuantity() < $order_item['quantity']) {
                    throw new \Exception('Amount exceeds the limit');
                }

                $categoryName = optional($product->category)->name;
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_name" => $product->name,
                    "product_image" => $product->image,
                    "purchase_price" => $product->purchase_price,
                    "selling_price" => $product->selling_price,
                    "category_name" => $categoryName,
                    "quantity" => $order_item["quantity"],
                ]);

                Stock::create([
                    "quantity" => $order_item["quantity"],
                    "type" => "decrease",
                    "product_id" => $order_item["product_id"],
                ]);
            }

            DB::commit();

            return $this->sendResponse(new TransactionDetailResource($order), "succes to transaction", 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            return response()->json([
                "message" => $th->getMessage(),
            ], 403);
        }
    }
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $this->sendResponse(new TransactionDetailResource($order), "Successfully get data", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
