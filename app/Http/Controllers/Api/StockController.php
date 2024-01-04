<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StockResource;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class StockController extends BaseController
{
    public function index()
    {
        $stocks = Stock::all();
        return $this->sendResponse(StockResource::collection($stocks), "Successfully get data", 200);
    }
    public function create(Request $request)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
                'type' => 'required',
                'product_id' => 'required',
            ]);

            if ($request->type == 'decrease') {
                $product = Product::findOrFail($request->product_id);
                $decreaseQuantity = $product->getTotalDecreaseQuantity($request->quantity) + $request->quantity;
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
}
