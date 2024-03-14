<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                case 'month':
                    $key = $transaction->created_at->format('d');
                    break;
                case 'year':
                    $key = $transaction->created_at->format('M');
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

    public function index()
    {
        try {
            $yearlyData = OrderItem::select(
                DB::raw('YEAR(created_at) as transaction_year'),
                DB::raw('COUNT(*) as transaction_count'),
                DB::raw('SUM(selling_price) as revenue'),
                DB::raw('SUM(purchase_price) as profit')
            )
                ->groupBy(DB::raw('YEAR(created_at)'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $yearlyData,
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function getReportsToday($day, $month, $year)
    {
        try {
            $dailyData = OrderItem::select(DB::raw('DATE_FORMAT(created_at, "%e %b %Y" ) as time'), DB::raw('DATE_FORMAT(created_at, "%H:%i:%s") as hour'), DB::raw('SUM(selling_price) as revenue'), DB::raw('SUM(purchase_price) as profit'))
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereDay('created_at', $day)
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%H:%i:%s")'), DB::raw('DATE_FORMAT(created_at, "%e %b %Y" )'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $dailyData,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function getReportsMonth($month, $year)
    {
        try {
            $dailyData = OrderItem::select(DB::raw('DATE_FORMAT(created_at, "%e %b %Y") as time'), DB::raw('COUNT(*) as transaction_count'), DB::raw('SUM(selling_price) as revenue'), DB::raw('COUNT(*) as transaction_count'), DB::raw('SUM(purchase_price) as profit'))
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%e %b %Y")'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $dailyData,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function getReportsYear($year)
    {
        try {
            $monthlyData = OrderItem::select(DB::raw('DATE_FORMAT(created_at, "%M") as time'), DB::raw('SUM(selling_price) as revenue'), DB::raw('COUNT(*) as transaction_count'), DB::raw('SUM(purchase_price) as profit'))
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('DATE_FORMAT(created_at, "%M")'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $monthlyData,
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
