<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        $previousUrl = url()->previous();
        $indexUrl = route('landing.index');
        $loginUrl = route('login');

        if ($previousUrl && $previousUrl !== $indexUrl && $previousUrl !== $loginUrl) {
            session(['url.intended' => $previousUrl]);
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email atau NIM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus berisi minimal 6 karakter.',
        ]);

        $loginInput = $request->input('email');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'student_id';

        $credentials = [
            $fieldType => $loginInput,
            'password' => $password,
        ];

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectAfterLogin(Auth::user());
        }

        throw ValidationException::withMessages([
            'email' => ['Email/NIM atau password tidak valid.'],
        ]);
    }

    protected function redirectAfterLogin($user)
    {
        $intendedUrl = session('url.intended');
        $indexUrl = route('landing.index');

        if ($intendedUrl && $intendedUrl !== $indexUrl) {
            session()->forget('url.intended');
            return redirect()->to($intendedUrl);
        }

        return $this->redirectBasedOnRole($user);
    }

    protected function redirectBasedOnRole($user)
    {
        if ($user->is_admin) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing.index');
    }
}
