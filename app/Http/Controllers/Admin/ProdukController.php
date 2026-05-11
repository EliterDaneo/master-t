<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProdukDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ProdukDataTable $dataTable)
    {
        return $dataTable->render('admin.produk.index');
    }

    public function create()
    {
        $categories = Category::latest()
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
        return view('admin.produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'content'     => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Upload Gambar
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('assets/back/img/produk/', $imageName, 'public');

        Produk::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'content'     => $request->content,
            'image'       => $imageName,
            'status'      => $request->has('status'), // true jika dicentang
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $categories = Category::latest()
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
        return view('admin.produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'content'     => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Handle Upload Gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('assets/back/img/produk/', $imageName, 'public');

            // Hapus Gambar lama jika ada
            if ($produk->image) {
                Storage::delete('assets/back/img/produk/' . $produk->image);
            }

            $produk->image = $imageName;
        }

        $produk->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'content'     => $request->content,
            'status'      => $request->has('status'), // true jika dicentang
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        // Hapus Gambar dari storage jika ada
        if ($produk->image) {
            Storage::delete('assets/back/img/produk/' . $produk->image);
        }

        $produk->delete();
        return response()->json(['message' => 'Produk berhasil dihapus.']);
    }
}
