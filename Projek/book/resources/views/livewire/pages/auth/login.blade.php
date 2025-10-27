<?php

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Helpers\SimpleEncryption;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'Email tidak ditemukan.');
            return;
        }

        try {
            Log::info('=== LOGIN DEBUG ===');
            Log::info('Email: ' . $user->email);

            // Ambil PIN dari database
            $pin = $user->pin; 

            if (empty($pin)) {
                $this->addError('password', 'PIN tidak ditemukan di akun ini.');
                return;
            }

            Log::info('PIN (from DB): ' . $pin);
            Log::info('Encrypted Password (DB): ' . substr($user->password, 0, 30) . '...');

            // Dekripsi password menggunakan PIN dari DB
            $decryptedPassword = SimpleEncryption::decrypt($user->password, $pin);

            Log::info('Decrypted Password: ' . $decryptedPassword);
            Log::info('Password Match: ' . ($decryptedPassword === $this->password ? 'YES' : 'NO'));

            if ($decryptedPassword !== $this->password) {
                $this->addError('password', 'Password salah.');
                return;
            }

            Auth::login($user, $this->remember);
            Session::regenerate();

            // Dekripsi nama untuk disimpan ke session
            try {
                $decryptedName = SimpleEncryption::decrypt($user->name, $pin);
                session(['real_name' => $decryptedName]);
                Log::info('Decrypted Name: ' . $decryptedName);
            } catch (\Throwable $e) {
                Log::error('Error dekripsi nama: ' . $e->getMessage());
                session(['real_name' => $user->name]);
            }

            // Ambil role_id dari tabel model_has_roles
            $roleId = DB::table('model_has_roles')
                ->where('model_id', $user->id)
                ->where('model_type', get_class($user))
                ->value('role_id');

            Log::info('Role ID: ' . ($roleId ?? 'NULL'));

            // Redirect berdasarkan role
            if ($roleId == 1) {
                $this->redirect(route('dashboard', absolute: false), navigate: true);
            } else {
                $this->redirect(route('welcome', absolute: false), navigate: true);
            }

        } catch (\Throwable $e) {
            Log::error('Login Error: ' . $e->getMessage());
            $this->addError('password', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
};
?>

<div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full"
                type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full pr-10"
                type="password" name="password" required autocomplete="current-password" />

            <button type="button" onclick="togglePassword('password', 'eye', 'eyeSlash')" 
                class="absolute right-3 top-9 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg id="eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 
                        9.542 7c-1.274 4.057-5.064 7-9.542 7
                        s-8.268-2.943-9.542-7z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg id="eyeSlash" xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                    class="w-5 h-5 hidden">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 001.5 12
                        c1.274 4.057 5.064 7 9.542 7
                        1.873 0 3.63-.513 5.118-1.402M6.228 6.228
                        A10.45 10.45 0 0112 5c4.478 0 8.268 2.943
                        9.542 7a10.523 10.523 0 01-4.18 5.042
                        M6.228 6.228L3 3m3.228 3.228l12.544 12.544" />
                </svg>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="remember" id="remember" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <div class="flex items-center space-x-3">
                <a href="{{ route('register') }}" 
                    class="px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                    {{ __('Register') }}
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>
    </form>

    <script>
    function togglePassword(inputId, eyeId, eyeSlashId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        const eyeSlash = document.getElementById(eyeSlashId);
        if (input.type === "password") {
            input.type = "text";
            eye.classList.add("hidden");
            eyeSlash.classList.remove("hidden");
        } else {
            input.type = "password";
            eye.classList.remove("hidden");
            eyeSlash.classList.add("hidden");
        }
    }
    </script>
</div>
