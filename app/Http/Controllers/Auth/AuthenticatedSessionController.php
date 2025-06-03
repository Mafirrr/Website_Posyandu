<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $login = $credentials['login'];
        $password = $credentials['password'];

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            if (Auth::guard('admin')->attempt([
                'email' => $login,
                'password' => $password,
            ], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard', absolute: false));
            }
        } else {
            if (Auth::guard('kader')->attempt([
                'nik' => $login,
                'password' => $password,
            ], $request->boolean('remember'))) {
                $anggota = Auth::guard('kader')->user();

                if (!in_array($anggota->role, ['kader', 'ibu_hamil_kader'])) {
                    Auth::guard('kader')->logout();
                    return back()->withErrors([
                        'login' => 'Akun ini tidak memiliki izin login sebagai kader.',
                    ]);
                }

                $request->session()->regenerate();
                return redirect()->intended(route('dashboard', absolute: false));
            }
        }

        throw ValidationException::withMessages([
            'login' => ['Login gagal. Periksa kembali email/NIK dan password Anda.'],
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('anggota')->check()) {
            Auth::guard('anggota')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
