<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $posts = $this->cari($request->q);

        return view('admin.berita.index', compact('posts'));
    }

    private function cari($q = null)
    {
        return Post::latest()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%');
            })
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->paginate(10);
    }

    public function create()
    {
        $categories = Category::latest()
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('admin.berita.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title'         => 'required|unique:posts',
            'category_id'   => 'required',
            'content'       => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('assets/back/img/berita/', $image->hashName(), 'public');

        $post = Post::create([
            'image'       => $image->hashName(),
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title'), '-'),
            'category_id' => $request->input('category_id'),
            'content'     => $request->input('content'),
            'user_id'     => Auth::user()->id
        ]);

        $post->save();

        if ($post) {
            return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('berita.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::latest()
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
        return view('admin.berita.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'title'         => 'required',
            'category_id'   => 'required',
            'content'       => 'required',
        ]);

        $post = Post::where('slug', $slug)->first();

        if ($request->file('image') == "") {

            $post->update([
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content'     => $request->input('content')
            ]);
        } else {

            //remove old image
            Storage::disk('public')->delete('assets/back/img/berita/' . $post->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('assets/back/img/berita/', $image->hashName(), 'public');

            $post->update([
                'image'       => $image->hashName(),
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content'     => $request->input('content')
            ]);
        }

        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('berita.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        // Logika Hak Akses: Admin bisa semua, User hanya milik sendiri
        if ($user->role === 'admin' || ($user->role === 'user' && $post->user_id === $user->id)) {

            // Hapus gambar jika ada
            if ($post->image) {
                Storage::disk('public')->delete('assets/back/img/berita/' . $post->image);
            }

            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus.'
            ]);
        }

        // Jika tidak punya akses
        return response()->json([
            'status' => 'error',
            'message' => 'Anda tidak memiliki hak akses untuk menghapus berita ini.'
        ], 403);
    }
}
