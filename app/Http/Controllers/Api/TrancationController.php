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
        try {
            $request->validate([
                "user_id"  => ['required'],
                "nominal"  => ['required'],
                "order_items"  => ['required'],
            ]);
            DB::beginTransaction();
            $order = Order::create([
                "user_id" => $request->user_id,
                "nominal" => $request->nominal,
            ]);

            $order_items = $request->order_items;
            foreach ($order_items as $order_item) {

                OrderItem::create([
                    "product_id" => $order_item["product_id"],
                    "order_id" => $order->id,
                    "quantity" => $order_item["quantity"]
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
                "order_items" => $request->items,
            ], "succes to transaction", 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            return response()->json([
                "message" => $th->getMessage(),
            ]);
        }
    }
}
