<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'jenis_layanan' => 'required',
            'judul' => 'required|max:150',
            'deskripsi' => 'required',
        ]);

        try {
            Order::create([
                'user_id' => Auth::id(), // Mengaitkan dengan admin/user yang menginput
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'jenis_layanan' => $request->jenis_layanan,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => 'pending',
            ]);

            return response()->json(['message' => 'Pesanan berhasil disimpan!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Data pesanan berhasil dihapus.']);
    }
}
