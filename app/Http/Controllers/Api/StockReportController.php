<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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
                ->select(
                    'products.id',
                    'products.name as product_name',
                    'products.product_code as product_code',
                    DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                    DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
                )
                ->groupBy('products.name', 'products.product_code')
                ->get();

            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function getReportsToday()
    {
        $currentDate = now();
        $year = $currentDate->year;
        $month = $currentDate->month;
        $day = $currentDate->day;
        try {
            $stockReport = DB::table('products')
                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                ->select(
                    'products.id',
                    'products.name as product_name',
                    'products.product_code as product_code',
                    DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                    DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
                )
                ->whereDay('stocks.created_at', $day)
                ->groupBy('products.name', 'products.product_code')
                ->get();

            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function getReportsMonth($month)
    {
        try {
            $stockReport = DB::table('products')
                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                ->select(
                    'products.id',
                    'products.name as product_name',
                    'products.product_code as product_code',
                    DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                    DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
                )
                ->whereMonth('stocks.created_at', $month)
                ->groupBy('products.name', 'products.product_code')
                ->get();

            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function getReportsYear($year)
    {
        try {
            $stockReport = DB::table('products')
                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                ->select(
                    'products.id',
                    'products.name as product_name',
                    'products.product_code as product_code',
                    DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                    DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
                )
                ->whereYear('stocks.created_at', $year)
                ->groupBy('products.name', 'products.product_code')
                ->get();

            if ($stockReport->count() == 0) {
                throw new \Exception("data not found");
            }
            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function customGetReports($date)
    {
        try {
            $stockReport = DB::table('products')
                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                ->select(
                    'products.id',
                    'products.name as product_name',
                    'products.product_code as product_code',
                    DB::raw('SUM(CASE WHEN stocks.type = "increase" THEN stocks.quantity ELSE 0 END) as increase'),
                    DB::raw('SUM(CASE WHEN stocks.type = "decrease" THEN stocks.quantity ELSE 0 END) as decrease')
                )
                ->whereDate('stocks.created_at', $date)
                ->groupBy('products.name', 'products.product_code')
                ->get();

            if ($stockReport->count() == 0) {
                throw new \Exception("data not found");
            }
            return $this->sendResponse(StockReportResource::collection($stockReport), 'Successfully get data', 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

}
