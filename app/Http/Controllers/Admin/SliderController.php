<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

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

        $imageName = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('assets/back/img/slider'), $imageName);

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

        $imageName = $slider->image;
        if ($request->hasFile('image')) {
            $oldPath = public_path('assets/back/img/slider/' . $slider->image);
            if (file_exists($oldPath)) unlink($oldPath);

            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('assets/back/img/slider'), $imageName);
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
        $oldPath = public_path('assets/back/img/slider/' . $slider->image);
        if (file_exists($oldPath)) unlink($oldPath);

        $slider->delete();

        return response()->json(['status' => 'success']);
    }
}
