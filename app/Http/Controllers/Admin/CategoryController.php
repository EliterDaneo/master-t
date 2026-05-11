<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0',
        ]);

        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['message' => 'Data berhasil disimpan.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0',
        ]);

        \App\Models\Category::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['message' => 'Data berhasil disimpan.']);
    }

    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'admin' || ($user->role === 'user' && $category->user_id === $user->id)) {

            // Cek relasi ke post
            if ($category->posts()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori tidak dapat dihapus karena masih memiliki berita terkait.'
                ], 422);
            }

            // Cek relasi ke produk
            if ($category->produks()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.'
                ], 422);
            }

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Anda tidak memiliki hak akses untuk menghapus data ini.'
        ], 403);
    }
}
