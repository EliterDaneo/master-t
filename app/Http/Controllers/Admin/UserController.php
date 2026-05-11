<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => 'required|in:admin,writer,user',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $avatarName = null;
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('assets/back/img/avatar'), $avatarName);
        }

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'asal_sekolah' => $request->asal_sekolah,
            'avatar'       => $avatarName,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|string|min:8|confirmed',
            'role'         => 'required|in:admin,writer,user',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $avatarName = $user->avatar;
        if ($request->hasFile('avatar')) {
            if ($avatarName) {
                $oldPath = public_path('assets/back/img/avatar/' . $avatarName);
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('assets/back/img/avatar'), $avatarName);
        }

        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'role'         => $request->role,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'asal_sekolah' => $request->asal_sekolah,
            'avatar'       => $avatarName,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            $oldPath = public_path('assets/back/img/avatar/' . $user->avatar);
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $user->delete();

        return response()->json(['status' => 'success']);
    }
}
