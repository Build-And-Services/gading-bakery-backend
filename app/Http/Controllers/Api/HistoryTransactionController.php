<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TransactionResource;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class HistoryTransactionController extends BaseController
{
    public function getReports($filter)
    {
        $startDate = $this->getStartDate($filter);
        $endDate = $this->getEndDate($filter);

        $transactions = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        return $this->sendResponse(TransactionResource::collection($transactions), 'Successfully get data', 200);
    }
    private function getStartDate($filter)
    {
        switch ($filter) {
            case 'today':
                return Carbon::today()->startOfDay();
            case 'month':
                return Carbon::now()->startOfMonth()->startOfDay();
            case 'year':
                return Carbon::now()->startOfYear()->startOfDay();
            default:
                return Carbon::today()->startOfDay();
        }
    }

    private function getEndDate($filter)
    {
        switch ($filter) {
            case 'today':
                return Carbon::today()->endOfDay();
            case 'month':
                return Carbon::now()->endOfMonth()->endOfDay();
            case 'year':
                return Carbon::now()->endOfYear()->endOfDay();
            default:
                return Carbon::today()->endOfDay();
        }
    }
}
