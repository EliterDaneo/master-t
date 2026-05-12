<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'password'     => 'required|string|min:8',
            'role'         => 'required|in:admin,writer,user',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $avatarName = null;

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

            $avatar->storeAs(
                'assets/back/img/avatar',
                $avatarName,
                'public'
            );
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

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|string|min:8',
            'role'         => 'required|in:admin,writer,user',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'asal_sekolah' => 'nullable|string|max:255',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $avatarName = $user->avatar;

        // Jika upload avatar baru
        if ($request->hasFile('avatar')) {

            // Hapus avatar lama
            if (
                $user->avatar &&
                Storage::disk('public')->exists('assets/back/img/avatar/' . $user->avatar)
            ) {
                Storage::disk('public')->delete('assets/back/img/avatar/' . $user->avatar);
            }

            // Upload avatar baru
            $avatar = $request->file('avatar');

            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

            $avatar->storeAs(
                'assets/back/img/avatar',
                $avatarName,
                'public'
            );
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

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->image && Storage::disk('public')->exists('assets/back/img/avatar/' . $user->image)) {
            Storage::disk('public')->delete('assets/back/img/avatar/' . $user->image);
        }

        $user->delete();

        return response()->json(['status' => 'success']);
    }
}
