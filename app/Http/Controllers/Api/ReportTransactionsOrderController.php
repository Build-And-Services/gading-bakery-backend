<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class ReportTransactionsOrderController extends Controller
{
    public function index()
    {
        try {
            $data = DB::table('order_items')->select('product_name', 'selling_price', DB::raw('DATE_FORMAT(created_at, "%e %b %Y" ) as tanggal'), 'quantity')
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
    public function reportDay($day, $month, $year)
    {
        try {
            $data = DB::table('order_items')->select('product_name', 'selling_price', DB::raw('DATE_FORMAT(created_at, "%e %b %Y" ) as tanggal'), 'quantity')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereDay('created_at', $day)
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
    public function reportMonth($month, $year)
    {
        try {
            $data = DB::table('order_items')->select('product_name', 'selling_price', DB::raw('DATE_FORMAT(created_at, "%e %b %Y" ) as tanggal'), 'quantity')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
    public function reportYear($year)
    {
        try {
            $data = DB::table('order_items')->select('product_name', 'selling_price', DB::raw('DATE_FORMAT(created_at, "%e %b %Y" ) as tanggal'), 'quantity')
                ->whereYear('created_at', $year)
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
