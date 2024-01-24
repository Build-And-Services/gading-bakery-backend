<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
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
            $transaksi = Order::all();
            return $this->sendResponse(TransactionResource::collection($transaksi), "Successfully get data", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
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

                OrderItem::create([
                    "product_id" => $order_item["product_id"],
                    "order_id" => $order->id,
                    "quantity" => $order_item["quantity"],
                    "purchase_price" => $product->purchase_price,
                    "selling_price" => $product->selling_price,
                ]);

                Stock::create([
                    "quantity" => $order_item["quantity"],
                    "type" => "decrease",
                    "product_id" => $order_item["product_id"],
                ]);
            }

            DB::commit();

            return $this->sendResponse([
                "order" => $order,
                "order_items" => $order->orderItems()->get(),
            ], "succes to transaction", 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            return response()->json([
                "message" => $th->getMessage(),
            ]);
        }
    }
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $this->sendResponse(new TransactionResource($order), "Successfully get data", 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
