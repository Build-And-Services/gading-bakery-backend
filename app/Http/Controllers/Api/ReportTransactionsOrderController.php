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

            $formattedData = [];
            $totalPrice = 0;

            foreach ($data as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    array_push($formattedData, [
                        'product_name' => $item->product_name,
                        'selling_price' => $item->selling_price,
                        'tanggal' => $item->tanggal,
                        'quantity' => 1
                    ]);
                    $totalPrice += $item->selling_price;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => [
                    'report' => $formattedData,
                    'total' => $totalPrice
                ],
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

            $formattedData = [];
            $totalPrice = 0;

            foreach ($data as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    array_push($formattedData, [
                        'product_name' => $item->product_name,
                        'selling_price' => $item->selling_price,
                        'tanggal' => $item->tanggal,
                        'quantity' => 1
                    ]);
                    $totalPrice += $item->selling_price;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => [
                    'report' => $formattedData,
                    'total' => $totalPrice
                ],
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

            $formattedData = [];
            $totalPrice = 0;

            foreach ($data as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    array_push($formattedData, [
                        'product_name' => $item->product_name,
                        'selling_price' => $item->selling_price,
                        'tanggal' => $item->tanggal,
                        'quantity' => 1
                    ]);
                    $totalPrice += $item->selling_price;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => [
                    'report' => $formattedData,
                    'total' => $totalPrice
                ],
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

            $formattedData = [];
            $totalPrice = 0;

            foreach ($data as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    array_push($formattedData, [
                        'product_name' => $item->product_name,
                        'selling_price' => $item->selling_price,
                        'tanggal' => $item->tanggal,
                        'quantity' => 1
                    ]);
                    $totalPrice += $item->selling_price;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => [
                    'report' => $formattedData,
                    'total' => $totalPrice
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
