<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('stocks', 'stocks.product_id', '=', 'products.id')
                        ->groupBy('products.id', 'products.name')
                        ->select(
                            'products.id', 
                            'products.name', 
                            'products.selling_price', 
                            'products.purchase_price', 
                            'categories.name as category',
                            DB::raw("SUM(CASE WHEN stocks.type = 'increase' THEN stocks.quantity ELSE -stocks.quantity END) AS total_stock")
                        )->get();

        $categories = DB::table('categories')->select('id', 'name')->get();

        return Inertia::render('Products/index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
