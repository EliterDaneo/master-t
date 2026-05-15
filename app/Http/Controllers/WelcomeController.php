<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dudi;
use App\Models\Order;
use App\Models\Post;
use App\Models\Produk;
use App\Models\Slider;
use App\Models\Struktur;
use App\Models\User;
use App\Models\Vm;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $category = Category::where('status', 1)->withCount('posts')->paginate(6);
        $beritas = Post::with(['category', 'user'])->where('status', 1)->latest()->limit(6)->get();
        $produks = Produk::where('status', 1)->latest()->limit(6)->get();
        $dudis = Dudi::latest()->limit(6)->get();
        $sliders = Slider::where('status', 1)->latest()->limit(6)->get();
        $vms = Vm::where('status', true)->get();
        $strukturs = Struktur::orderBy('position_level')->orderBy('order')->get();
        return view('welcome', compact('category', 'beritas', 'produks', 'dudis', 'vms', 'strukturs', 'sliders'));
    }

    public function berita()
    {
        $beritas = Post::latest()->paginate(10);
        return view('home.berita.index', compact('beritas'));
    }

    public function showBerita($slug)
    {
        $post = Post::with(['category', 'user'])->where('slug', $slug)->firstOrFail();

        $beritaTerkait = Post::with('category')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        $beritaTerbaru = Post::latest()->take(5)->get();

        $categories = Category::withCount('posts')->get();

        return view('home.berita.show', compact(
            'post',
            'beritaTerkait',
            'beritaTerbaru',
            'categories'
        ));
    }

    public function produk()
    {
        $produks = Produk::latest()->paginate(10);
        return view('home.produk.index', compact('produks'));
    }

    public function showProduk($slug)
    {
        $produk = Produk::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $produkTerkait = Produk::with('category')
            ->where('category_id', $produk->category_id)
            ->where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();

        $produkTerbaru = Produk::latest()
            ->take(5)
            ->get();

        $categories = Category::withCount('produks')->get();

        return view('home.produk.show', compact(
            'produk',
            'produkTerkait',
            'produkTerbaru',
            'categories'
        ));
    }

    public function order()
    {
        $sekolahs = User::select('id', 'asal_sekolah')->where('role', '!=', 'admin')
            ->get();
        $categories = Category::where('status', 1)->withCount('posts')->paginate(6);

        return view('home.order.index', compact('sekolahs', 'categories'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'no_hp'         => 'required|string|max:20',
            'email'         => 'nullable|email|max:100',
            'jenis_layanan' => 'required|string',
            'judul'         => 'required|string|max:150',
            'deskripsi'     => 'required|string',
            'sekolah'       => 'required|exists:users,id',
        ], [
            'required' => ':attribute wajib diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'email'    => 'Format email tidak valid.'
        ]);

        try {
            // 2. Simpan Data
            Order::create([
                'nama'          => $request->nama,
                'no_hp'         => $request->no_hp,
                'email'         => $request->email,
                'jenis_layanan' => $request->jenis_layanan,
                'judul'         => $request->judul,
                'deskripsi'     => $request->deskripsi,
                'user_id'       => $request->sekolah
            ]);

            // 3. Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Pesanan Anda telah berhasil dikirim! Tim kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            // Jika ada error database atau sistem
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function kontak()
    {
        return view('home.kontak.index');
    }
}
