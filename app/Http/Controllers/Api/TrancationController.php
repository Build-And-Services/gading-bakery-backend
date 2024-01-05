<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrancationController extends BaseController
{
    public function createTransaction(Request $request)
    {
        $request->validate([
            "user_id"  => ['required'],
            "nominal"  => ['required'],
            "order_items"  => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $order = Order::create([
                "user_id" => $request->id,
                "nominal" => $request->nominal,
            ]);

            $order_items = $request->order_items;
            foreach ($order_items as $order_item) {
                OrderItem::create([
                    "product_id" => $order_item->product_id,
                    "order_id" => $order->id,
                    "quantity" => $order_item->quantity
                ]);

                $product = Product::find($order_item->product_id);
                $product->upddate([
                    "quantity" => $product->stock - $order_item->quantity,
                ]);
            }

            DB::commit();

            return $this->sendResponse([
                "order" => $order,
                "order_items" => $request->items,
            ], "succes to transaction", 201);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
