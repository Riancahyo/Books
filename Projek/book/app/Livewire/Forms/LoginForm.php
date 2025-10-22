<?php

namespace App\Livewire\Forms;

use App\Helpers\SimpleEncryption;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Ambil user berdasarkan email
        $user = \App\Models\User::where('email', $this->email)->first();

        if (!$user) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'),
            ]);
        }

        // === 🔐 PERBAIKAN: Dekripsi password dari database, lalu bandingkan ===
        try {
            if (empty($user->pin)) {
                throw new \Exception('PIN tidak ditemukan');
            }

            // Dekripsi password yang tersimpan di database
            $decryptedPassword = SimpleEncryption::decrypt($user->password, $user->pin);

            // Bandingkan dengan input password
            if ($decryptedPassword !== $this->password) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'form.password' => 'Password salah.',
                ]);
            }

        } catch (\Throwable $e) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'form.password' => 'Terjadi kesalahan saat verifikasi password.',
            ]);
        }

        // Jika password cocok → login manual
        Auth::login($user, $this->remember);

        // === 🔓 Dekripsi nama untuk ditampilkan di session ===
        try {
            $decryptedName = SimpleEncryption::decrypt($user->name, $user->pin);
            session(['real_name' => $decryptedName]);
        } catch (\Throwable $e) {
            session(['real_name' => $user->name]);
        }

        // Ambil role_id dari tabel model_has_roles
        $roleId = DB::table('model_has_roles')
            ->where('model_id', $user->id)
            ->where('model_type', get_class($user))
            ->value('role_id');

        // Validasi role (1 = admin, 2 = user)
        if (!in_array($roleId, [1, 2])) {
            Auth::logout();
            throw ValidationException::withMessages([
                'form.email' => 'Access denied: Invalid role.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}