<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DudiDataTable;
use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DudiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DudiDataTable $dataTable)
    {
        return $dataTable->render('admin.dudi.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'image'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'required|url|max:255',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('assets/back/img/dudi/', $imageName, 'public');

        Dudi::create([
            'name'   => $request->name,
            'bidang' => $request->bidang,
            'image'  => $imageName,
            'link'   => $request->link,
        ]);

        return redirect()->route('dudi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Dudi $dudi)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'required|url|max:255',
            'status' => 'required|in:0,1',
        ]);

        $imageName = $dudi->image;

        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($dudi->image && Storage::disk('public')->exists('assets/back/img/dudi/' . $dudi->image)) {
                Storage::disk('public')->delete('assets/back/img/dudi/' . $dudi->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('assets/back/img/dudi', $imageName, 'public');
        }

        $dudi->update([
            'name'   => $request->name,
            'bidang' => $request->bidang,
            'image'  => $imageName,
            'link'   => $request->link,
            'status' => $request->status,
        ]);

        return redirect()->route('dudi.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Dudi $dudi)
    {
        if ($dudi->image && Storage::disk('public')->exists('assets/back/img/dudi/' . $dudi->image)) {
            Storage::disk('public')->delete('assets/back/img/dudi/' . $dudi->image);
        }

        // Hapus data
        $dudi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
