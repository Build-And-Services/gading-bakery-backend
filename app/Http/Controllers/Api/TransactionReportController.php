<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionReportController extends Controller
{
    public function getReports($filter)
    {
        $startDate = $this->getStartDate($filter);
        $endDate = $this->getEndDate($filter);

        $transactions = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        $profit = 0;
        $revenue = 0;
        $details = [];
        foreach ($transactions as $transaction) {
            $profit += $transaction->calculateProfit();
            $revenue += $transaction->calculateTotalOrderPrice();

            switch ($filter) {
                case 'today':
                    $key = $transaction->created_at->format('H:i');
                    break;
                case 'yesterday':
                    $key = $transaction->created_at->format('H:i');
                    break;
                default:
                    $key = $transaction->created_at->format('H:i');
                    break;

            }

            if (!isset($details[$key])) {
                $details[$key] = [
                    'indicator' => $key,
                    'profit' => 0,
                    'revenue' => 0,
                    'total_transactions' => 0
                ];
            }

            $details[$key]['profit'] += $transaction->calculateProfit();
            $details[$key]['revenue'] += $transaction->calculateTotalOrderPrice();
            $details[$key]['total_transactions']++;
        }

        return response()->json([
            'profit' => $profit,
            'revenue' => $revenue,
            'details' => array_values($details)
        ]);
    }
    private function getStartDate($filter)
    {
        switch ($filter) {
            case 'today':
                return Carbon::today()->startOfDay();
            case 'yesterday':
                return Carbon::yesterday()->startOfDay();
           default:
                return Carbon::parse($filter)->startOfDay();
        }
    }

    private function getEndDate($filter)
    {
        switch ($filter) {
            case 'today':
                return Carbon::today()->endOfDay();
            case 'yesterday':
                return Carbon::yesterday()->endOfDay();
            default:
                return Carbon::parse($filter)->endOfDay();
        }
    }
}
