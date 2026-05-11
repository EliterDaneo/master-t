<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $strukturs = $this->cari($request->q);

        return view('admin.struktur.index', compact('strukturs'));
    }

    private function cari($q = null)
    {
        return Struktur::latest()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            })
            ->paginate(10);
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'title'          => 'required|string|max:255',
            'position_label' => 'required|string|max:255',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bg_color'       => 'required|string|max:50',
            'position_level' => 'required|integer',
            'order'          => 'required|integer',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('assets/back/img/struktur/', $imageName, 'public');

        Struktur::create([
            'name'           => $request->name,
            'title'          => $request->title,
            'position_label' => $request->position_label,
            'image'          => $imageName,
            'bg_color'       => $request->bg_color,
            'position_level' => $request->position_level,
            'order'          => $request->order,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Struktur $struktur)
    {
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, Struktur $struktur)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'title'          => 'required|string|max:255',
            'position_label' => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bg_color'       => 'required|string|max:50',
            'position_level' => 'required|integer',
            'order'          => 'required|integer',
        ]);

        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($struktur->image && Storage::disk('public')->exists('assets/back/img/struktur/' . $struktur->image)) {
                Storage::disk('public')->delete('assets/back/img/struktur/' . $struktur->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('assets/back/img/struktur', $imageName, 'public');

            $struktur->image = $imageName;
        }

        $struktur->update([
            'name'           => $request->name,
            'title'          => $request->title,
            'position_label' => $request->position_label,
            'bg_color'       => $request->bg_color,
            'position_level' => $request->position_level,
            'order'          => $request->order,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Struktur $struktur)
    {
        if ($struktur->image && Storage::disk('public')->exists('assets/back/img/struktur/' . $struktur->image)) {
            Storage::disk('public')->delete('assets/back/img/struktur/' . $struktur->image);
        }

        $struktur->delete();

        return response()->json(['status' => 'success']);
    }
}
