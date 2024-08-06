<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách các danh mục
        $categories = Category::query()->where('status', 1)->get();

        // Lấy danh sách các sản phẩm với danh mục liên quan
        $products = Product::where('status', 1)->with('category')->get();
        
        // Lấy danh sách các sản phẩm thịnh hành theo lượt xem
        $trendingProducts = Product::where('status', 1)
            ->orderBy('luot_xem', 'desc')
            ->take(8)
            ->with('category') // Đảm bảo thông tin danh mục cũng được lấy
            ->get();
        
        // Trả về view với dữ liệu
        $user = Auth::user();
        return view('user.index', compact('categories', 'products', 'user', 'trendingProducts'));
    }
    public function show($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::withCategoryName()->findOrFail($id);

        $products = Product::query()->where('status', 1)->get();
        // Trả về view chi tiết với dữ liệu sản phẩm
        return view('user.detail', compact('product','products'));
    }
    public function showByCategory($id)
    {
        // Lấy danh mục theo ID
        $category = Category::findOrFail($id);

        // Lấy sản phẩm thuộc danh mục đó
        $products = Product::where('category_id', $id)->get();

        // Trả về view với dữ liệu danh mục và sản phẩm
        return view('user.seachCategory', compact('category', 'products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category_id = $request->input('category_id');

        // Lấy danh mục để hiển thị trên view
        
        $categories = Category::all();

        // Tìm kiếm sản phẩm
        $products = Product::query()
            ->when($query, function($queryBuilder, $query) {
                return $queryBuilder->where('name', 'like', "%{$query}%");
            })
            ->when($category_id, function($queryBuilder, $category_id) {
                return $queryBuilder->where('category_id', $category_id);
            })
            ->get();

        return view('user.seach', compact('products', 'categories'));
        }
    public function showAdmin(){
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

        return view('admin.index', [
            'new_registrations' => $newRegistrations,
            'total_products' => $totalProducts,
            'total_sold_products' => $totalSoldProducts,
            'total_revenue' => $totalRevenue,
            'revenue_by_date' => $revenueByDate,
            'new_registrations_by_date' => $newRegistrationsByDate,
            'sold_products_by_date' => $soldProductsByDate
        ]);
       
    }
    public function showDetailUser(User $user)
    {
        // Trả về view chi tiết tài khoản với dữ liệu tài khoản
        return view('user.detailUser', compact('user'));
    }
    
}
