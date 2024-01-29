<?php

namespace App\Http\Controllers\Api;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\StockReportResource;
use App\Http\Controllers\Api\BaseController as BaseController;

class StockReportController extends BaseController
{
    public function index()
    {
        try {
            $stockReport = DB::table('products')
            ->join('stocks', 'products.id', '=', 'stocks.product_id')
            ->select('products.name as product_name', 'products.product_code as product_code',
                DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
            )
            ->groupBy('products.name', 'products.product_code')
            ->get();

            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        }  catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}
