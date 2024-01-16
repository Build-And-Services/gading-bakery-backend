<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\ReportResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;

class ReportController extends BaseController
{
    public function index()
    {
        try {
            $orders = Order::with('orderItems.products.category')->get();

            $totalTransaction = $orders->count('id');
            $totalPrice = 0;
            $transactionDetail = [];

            foreach ($orders as $order) {
                $orderItems = $order->orderItems;
                $orderTotalPrice = $orderItems->sum(function ($orderItem) {
                    return $orderItem->products->selling_price * $orderItem->quantity;
                });

                $orderTotalQuantity = $orderItems->sum('quantity');

                $transactionDetail[] = [
                    'order_id' => $order->id,
                    // 'total_quantity' => $orderTotalQuantity,
                    // 'total_price' => $orderTotalPrice,
                    'transactions' => $orderItems->map(function ($orderItem) {
                        return [
                            'product_id' => $orderItem->products->id,
                            'total_quantity' => $orderItem->quantity,
                            'total_nominal' => $orderItem->products->selling_price * $orderItem->quantity,
                        ];
                    }),
                    'products' => $orderItems->map(function ($orderItem) {
                        return [
                            'name' => $orderItem->products->name,
                            'category' => $orderItem->products->category->name,
                            'total_quantity' => $orderItem->quantity,
                            'selling_price' => $orderItem->products->selling_price,
                        ];
                    })->toArray(),

                ];

                $totalPrice += $orderTotalPrice;
            }

            return response()->json([
                "total_transaction" => $totalTransaction,
                "price_transaction" => $totalPrice,
                "transaction" => $transactionDetail,
            ]);
    } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
