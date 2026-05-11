<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Login failed. Please check your credentials and try again.');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8',
            'phone'        => 'required|numeric|digits_between:10,15',
            'address'      => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'avatar'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'phone.numeric' => 'Nomor telepon harus berupa angka.',
            'phone.digits_between' => 'Nomor telepon harus di antara 10 sampai 15 karakter.',
        ]);

        try {
            $fileName = null;
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = str_replace(' ', '_', strtolower($validatedData['name'])) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('assets/back/img/avatar', $fileName, 'public');
            }

            $user = \App\Models\User::create([
                'name'         => $validatedData['name'],
                'email'        => $validatedData['email'],
                'password'     => Hash::make($validatedData['password']),
                'phone'        => $validatedData['phone'],
                'address'      => $validatedData['address'],
                'asal_sekolah' => $validatedData['asal_sekolah'],
                'avatar'       => $fileName,
                'role'         => 'user',
            ]);

            Auth::login($user);
            return redirect('/admin/dashboard')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftar: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
