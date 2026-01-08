<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Elektronik;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics
        $totalElektronik = Elektronik::count();
        $totalPesanan = Pesanan::count();
        $totalStok = Elektronik::sum('stok');
        $stokMenipis = Elektronik::where('stok', '<', 10)->count();
        
        // Revenue Calculations
        $pendapatanBulanIni = Pesanan::where('setatus_pembayaran', 'dibayar')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->sum(function($pesanan) {
                return ($pesanan->elektronik->harga ?? 0) * $pesanan->jumlah_pesanan;
            });
            
        $pendapatanHariIni = Pesanan::where('setatus_pembayaran', 'dibayar')
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->sum(function($pesanan) {
                return ($pesanan->elektronik->harga ?? 0) * $pesanan->jumlah_pesanan;
            });
        
        // Order Status Distribution
        $statusPesanan = [
            'dibayar' => Pesanan::where('setatus_pembayaran', 'dibayar')->count(),
            'menunggu' => Pesanan::where('setatus_pembayaran', 'menunggu')->count(),
            'gagal' => Pesanan::where('setatus_pembayaran', 'gagal')->count(),
        ];
        
        // Today's Statistics
        $pesananHariIni = Pesanan::whereDate('created_at', Carbon::today())->count();
        $produkTerjualHariIni = Pesanan::whereDate('created_at', Carbon::today())->sum('jumlah_pesanan');
        $produkBaruHariIni = Elektronik::whereDate('created_at', Carbon::today())->count();
        
        // Recent Data
        $pesananTerbaru = Pesanan::with('elektronik')
            ->latest()
            ->take(5)
            ->get();
            
        $produkStokRendah = Elektronik::where('stok', '<', 10)
            ->latest()
            ->take(5)
            ->get();
            
        $elektroniks = Elektronik::latest()->take(5)->get();
        
        // Chart Data
        $chartData = $this->getChartData();
        
        // Recent Activity
        $aktivitasTerbaru = $this->getRecentActivity();
        
        return view('admin.dashboard', compact(
            'totalElektronik',
            'totalPesanan',
            'totalStok',
            'stokMenipis',
            'pendapatanBulanIni',
            'pendapatanHariIni',
            'statusPesanan',
            'pesananHariIni',
            'produkTerjualHariIni',
            'produkBaruHariIni',
            'pesananTerbaru',
            'produkStokRendah',
            'elektroniks',
            'chartData',
            'aktivitasTerbaru'
        ));
    }
    
    private function getChartData()
    {
        $data = [];
        $months = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $revenue = Pesanan::where('setatus_pembayaran', 'dibayar')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->get()
                ->sum(function($pesanan) {
                    return ($pesanan->elektronik->harga ?? 0) * $pesanan->jumlah_pesanan;
                });
                
            $data[] = $revenue;
        }
        
        return [
            'labels' => $months,
            'values' => $data
        ];
    }
    
    private function getRecentActivity()
    {
        $activities = [];
        
        // Recent orders
        $recentOrders = Pesanan::with('elektronik')
            ->latest()
            ->take(3)
            ->get();
            
        foreach ($recentOrders as $order) {
            $activities[] = [
                'type' => 'pesanan',
                'title' => 'Pesanan Baru',
                'description' => $order->nama_pemesan . ' memesan ' . $order->elektronik->nama_barang,
                'time' => $order->created_at->diffForHumans()
            ];
        }
        
        // Low stock products
        $lowStock = Elektronik::where('stok', '<', 5)->latest()->take(2)->get();
        
        foreach ($lowStock as $product) {
            $activities[] = [
                'type' => 'warning',
                'title' => 'Stok Menipis',
                'description' => $product->nama_barang . ' tersisa ' . $product->stok . ' unit',
                'time' => $product->updated_at->diffForHumans()
            ];
        }
        
        // New products
        $newProducts = Elektronik::latest()->take(2)->get();
        
        foreach ($newProducts as $product) {
            $activities[] = [
                'type' => 'produk',
                'title' => 'Produk Baru',
                'description' => $product->nama_barang . ' ditambahkan',
                'time' => $product->created_at->diffForHumans()
            ];
        }
        
        // Sort by time
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        return array_slice($activities, 0, 6);
    }
    
    public function chartData(Request $request)
    {
        $periode = $request->get('periode', 'month');
        
        // Implement logic to return chart data based on period
        return response()->json($this->getChartData());
    }
}