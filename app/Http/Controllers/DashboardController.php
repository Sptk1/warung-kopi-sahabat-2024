<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            "total_transaksi" => Transaksi::where('status', true)
                ->whereDate('created_at', Carbon::today())
                ->count(),
            "total_menus" => Menu::all()->count(),
            'total_sales' => Transaksi::select(Transaksi::raw('SUM(total_transaksi) as total_sales'))->whereDate('created_at', NOW()->toDateString())->get(),
            'total_income' => Transaksi::select(Transaksi::raw('SUM(total_pembayaran) as total_income'))->whereDate('created_at', NOW()->toDateString())->get(),
            'invoice' => Transaksi::select(Transaksi::raw('COUNT(id) as total_invoice'))->whereDate('created_at', NOW()->toDateString())->get(),
            'kasir' => User::whereHas('peran', fn($query) => $query->where('peran', 'Kasir'))->count(),
            'admin' => User::whereHas('peran', fn($query) => $query->where('peran', 'Admin'))->count(),
            'total_user' => User::all()->count(),
            'total_paid' => Transaksi::select(Transaksi::raw('COUNT(id) as total_paid'))->where('status', true)->get(),
            'total_unpaid' => Transaksi::select(Transaksi::raw('COUNT(id) as total_unpaid'))->where('status', false)->get(),
            // 'tables' => Transaksi::select(Transaksi::raw('COUNT(no_table) as tables'))->where('status', false)->get()
        ]);
    }
}
