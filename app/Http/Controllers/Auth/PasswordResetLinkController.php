<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): \Illuminate\View\View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 1. Jalankan logika asli Laravel (membuat token di DB & menulis ke laravel.log)
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            // 2. AMBIL TOKEN DEMO: Ambil data user terkait
            $user = \App\Models\User::where('email', $request->email)->first();
            
            // 3. Buat ulang string token valid dari repository database Laravel
            $token = Password::getRepository()->create($user);
            
            // 4. Susun URL reset password secara dinamis
            $demoUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);

            // 5. Kembalikan halaman dengan membawa pesan sukses DAN URL demo bypass
            return back()
                ->with('status', __($status))
                ->with('demo_url', $demoUrl);
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}