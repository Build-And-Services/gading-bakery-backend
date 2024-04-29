<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductStockResource;
use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class StockController extends BaseController
{
    public function getAllStocks()
    {
        $stocks = Stock::all();
        return $this->sendResponse(StockResource::collection($stocks), "Successfully get data", 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
                'type' => 'required',
                'product_id' => 'required|exists:products,id',
            ]);

            if ($request->type == 'decrease') {
                $product = Product::findOrFail($request->product_id);
                $decreaseQuantity = $product->getTotalDecreaseQuantity() + $request->quantity;
                if ($decreaseQuantity > $product->getTotalIncreaseQuantity()) {
                    return $this->sendError('Amount exceeds the limit', 400);
                }
            }

            $stock = Stock::create($request->all());
            return $this->sendResponse(new StockResource($stock), 'Successfully add stocks', 201);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function getProductStocks(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $stockHistory = $product->stocks()->latest()->get();

            $increaseQuantity = $product->getTotalIncreaseQuantity();
            $decreaseQuantity = $product->getTotalDecreaseQuantity();
            $totalQuantity = $increaseQuantity - $decreaseQuantity;

            return $this->sendResponse(new ProductStockResource($product, $stockHistory, $totalQuantity, $totalQuantity * $product->purchase_price), 'Successfully get product stocks', 200);
            // 'product' => $product,
            // 'stocks' => $stockHistory,
            // 'totalQuantity' => $totalQuantity,
            // 'totalResidual' => $totalQuantity * $product->purchase_price
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}