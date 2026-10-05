<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers'    => User::count(),
            'totalProducts' => Product::count(),
            'totalOrders'   => Order::count(),
            'revenue'       => Order::paid()->sum('total'),
            'latestOrders'  => Order::with('user')->latest()->take(5)->get(),
            'usersByRole'   => User::select('role', DB::raw('count(*) as total'))
                                   ->groupBy('role')->pluck('total', 'role'),
        ]);
    }

    /** Bonus: demo N+1 vs eager loading. */
    public function eagerDemo()
    {
        DB::enableQueryLog();

        DB::flushQueryLog();
        Product::take(20)->get()->each(fn ($p) => $p->category->name); // N+1
        $lazyCount = count(DB::getQueryLog());

        DB::flushQueryLog();
        Product::with('category')->take(20)->get()->each(fn ($p) => $p->category->name);
        $eagerCount = count(DB::getQueryLog());

        return view('admin.eager-demo', compact('lazyCount', 'eagerCount'));
    }
}