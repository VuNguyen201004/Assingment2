<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{



    public function getStatistics()
    {
        $newRegistrations = DB::table('users')->whereDate('created_at', '>=', now()->subMonth())->count();
        $totalProducts = DB::table('products')->count();
        $totalSoldProducts = DB::table('order_items')->sum('quantity');
        $totalRevenue = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->sum(DB::raw('order_items.quantity * order_items.price'));
        $revenueByDate = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('date')
            ->pluck('revenue', 'date')
            ->toArray();

        // Thêm dữ liệu cho các biểu đồ khác
        $newRegistrationsByDate = DB::table('users')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(id) as count'))
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $soldProductsByDate = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('SUM(order_items.quantity) as count'))
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return view('admin.statistics.index', [
            'new_registrations' => $newRegistrations,
            'total_products' => $totalProducts,
            'total_sold_products' => $totalSoldProducts,
            'total_revenue' => $totalRevenue,
            'revenue_by_date' => $revenueByDate,
            'new_registrations_by_date' => $newRegistrationsByDate,
            'sold_products_by_date' => $soldProductsByDate
        ]);
    }
    }
    
    


