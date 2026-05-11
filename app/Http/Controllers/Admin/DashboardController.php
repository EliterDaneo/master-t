<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalBerita = Auth::user()->role == 'admin'
            ? Post::count()
            : Post::where('user_id', Auth::user()->id)->count();

        $totalProduk = Auth::user()->role == 'admin'
            ? Produk::count()
            : Produk::where('user_id', Auth::user()->id)->count();

        $totalOrder = Auth::user()->role == 'admin'
            ? Order::count()
            : Order::where('user_id', Auth::user()->id)->count();

        $totalPengguna = User::count();

        // Berita terbaru
        $beritaTerbaru = Auth::user()->role == 'admin'
            ? Post::with('category')->latest()->take(5)->get()
            : Post::with('category')->where('user_id', Auth::user()->id)->latest()->take(5)->get();

        // Chart data 6 bulan terakhir
        $chartData = [
            'months' => [],
            'counts' => [],
        ];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $chartData['months'][] = $date->format('M Y');
            $query = Post::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
            if (Auth::user()->role != 'admin') {
                $query->where('user_id', Auth::user()->id);
            }
            $chartData['counts'][] = $query->count();
        }

        return view('admin.dashboard.index', compact(
            'totalBerita',
            'totalProduk',
            'totalOrder',
            'totalPengguna',
            'beritaTerbaru',
            'chartData'
        ));
    }
}
