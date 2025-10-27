<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use App\Helpers\SimpleEncryption;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        $user = Auth::user();

        // Validasi input dasar
        $validated = $this->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        // === CEK PASSWORD LAMA ===
        try {
            $decryptedPassword = SimpleEncryption::decrypt($user->password, $user->pin); 
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'current_password' => 'Gagal mendekripsi password lama.',
            ]);
        }

        if ($validated['current_password'] !== $decryptedPassword) {
            throw ValidationException::withMessages([
                'current_password' => 'Password lama salah.',
            ]);
        }

        // === UPDATE PASSWORD BARU ===
        $encryptedNewPassword = SimpleEncryption::encrypt($validated['password'], $user->pin);

        $user->update([
            'password' => $encryptedNewPassword,
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
};
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">

        {{-- Current Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input 
                wire:model="current_password" 
                id="update_password_current_password" 
                name="current_password" 
                x-bind:type="show ? 'text' : 'password'"
                class="mt-1 block w-full pr-10" 
                autocomplete="current-password" 
            />
            <!-- Icon -->
            <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.042-3.362m3.257-2.564A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.497 5.385M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input 
                wire:model="password" 
                id="update_password_password" 
                name="password" 
                x-bind:type="show ? 'text' : 'password'" 
                class="mt-1 block w-full pr-10" 
                autocomplete="new-password" 
            />
            <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.042-3.362m3.257-2.564A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.497 5.385M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input 
                wire:model="password_confirmation" 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                x-bind:type="show ? 'text' : 'password'" 
                class="mt-1 block w-full pr-10" 
                autocomplete="new-password" 
            />
            <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.042-3.362m3.257-2.564A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.497 5.385M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest 
                    hover:bg-green-700 focus:bg-green-700 active:bg-green-800 
                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>

            <x-action-message class="me-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
