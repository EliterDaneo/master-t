<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('assets/back/img/slider/', $imageName, 'public');

        Slider::create([
            'title'  => $request->title,
            'image'  => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan!');
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($slider->image && Storage::disk('public')->exists('assets/back/img/slider/' . $slider->image)) {
                Storage::disk('public')->delete('assets/back/img/slider/' . $slider->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('assets/back/img/slider', $imageName, 'public');

            $slider->image = $imageName;
        }

        $slider->update([
            'title'  => $request->title,
            'image'  => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil diperbarui!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && Storage::disk('public')->exists('assets/back/img/slider/' . $slider->image)) {
            Storage::disk('public')->delete('assets/back/img/slider/' . $slider->image);
        }

        $slider->delete();

        return response()->json(['status' => 'success']);
    }
}
