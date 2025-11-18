<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();

        $stats = [
            'orders_count' => Order::count(),
            'orders_today' => Order::whereDate('created_at', $today)->count(),
            'revenue_total' => Order::whereIn('status', ['processing', 'shipped', 'completed'])->sum('total_price'),
            'revenue_today' => Order::whereDate('created_at', $today)
                ->whereIn('status', ['processing', 'shipped', 'completed'])
                ->sum('total_price'),
            'top_products' => Product::withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->take(5)->get(),
            'active_users' => User::whereHas('orders')->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
