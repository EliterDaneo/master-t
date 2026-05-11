<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vm;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $vms = $this->cari($request->q);

        return view('admin.vm.index', compact('vms'));
    }

    private function cari($q = null)
    {
        return Vm::latest()
            ->when($q, function ($query) use ($q) {
                $query->where('content', 'like', '%' . $q . '%');
            })
            ->paginate(10);
    }

    public function create()
    {
        return view('admin.vm.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'    => 'required|in:vision,mission',
            'h' => 'required|string',
            'order'   => 'required|integer',
            'status'  => 'required|in:1,0',
        ]);

        Vm::create([
            'type'    => $request->type,
            'content' => $request->h,
            'order'   => $request->order,
            'status'  => $request->status,
        ]);

        return redirect()->route('vm.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Vm $vm)
    {
        return view('admin.vm.edit', compact('vm'));
    }

    public function update(Request $request, Vm $vm)
    {
        $request->validate([
            'type'    => 'required|in:vision,mission',
            'content' => 'required|string',
            'order'   => 'required|integer',
            'status'  => 'boolean',
        ]);

        $vm->update([
            'type'    => $request->type,
            'content' => $request->content,
            'order'   => $request->order,
            'status'  => $request->has('status'),
        ]);

        return redirect()->route('vm.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Vm $vm)
    {
        $vm->delete();

        return response()->json(['status' => 'success']);
    }
}
