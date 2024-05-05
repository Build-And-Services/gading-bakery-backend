<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryDetailReportResource;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ReportResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\ProductReportResource;
use App\Http\Resources\CategoryReportResource;
use App\Http\Controllers\Api\BaseController as BaseController;

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
                    return $orderItem->selling_price * $orderItem->quantity;
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
                            'category' => $orderItem->products->category,
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
    public function productReports()
    {
        try {
            $order = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->get();

            return $this->sendResponse(ProductReportResource::collection($order), 'Successfully get data', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
    public function showProductReports($productId)
    {
        try {
            $order = OrderItem::where('product_id', $productId)
                ->select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->get();

            return $this->sendResponse(ProductReportResource::collection($order), 'Successfully get data', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
    public function categoryReports()
    {
        try {
            $salesData = OrderItem::select('category_name', \DB::raw('SUM(order_items.quantity) as total_quantity'))
                ->groupBy('category_name')
                ->get();

            return $this->sendResponse(CategoryReportResource::collection($salesData), 'Successfully get data', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
    public function showCategoryReports($categoryId)
    {
        try {
            $query = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select(
                    'categories.name as category_name',
                    'products.name as product_name',
                    \DB::raw('SUM(order_items.quantity) as total_quantity')
                )
                ->groupBy('categories.id', 'products.id')
                ->where('categories.id', $categoryId)->get();
            if (count($query) == 0) {
                throw new \Exception('Data not found');
            }

            return $this->sendResponse(CategoryDetailReportResource::collection($query), 'Successfully get data', 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
