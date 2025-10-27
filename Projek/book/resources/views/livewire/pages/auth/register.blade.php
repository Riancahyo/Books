<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use App\Helpers\SimpleEncryption;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $pin = '';
    public string $role = 'user'; 

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'pin' => ['required', 'digits:6'],
            'role' => ['required', 'in:admin,user'], // Ensure valid role is selected
        ]);

        // // Hash password
        // $validated['password'] = Hash::make($validated['password']);

        // Enkripsi name dan password dengan PIN sebagai kunci
        $encryptedName = SimpleEncryption::encrypt($validated['name'], $validated['pin']);
        $encryptedPassword = SimpleEncryption::encrypt($validated['password'], $validated['pin']);

        // Create user
        $user = User::create([
            'name' => $encryptedName,
            'email' => $validated['email'],
            'password' => $encryptedPassword,
            'pin' => $validated['pin'],
        ]);

        // Assign role using Spatie Permission
        $role = Role::firstOrCreate(['name' => $validated['role']]);
        $user->assignRole($role);

        // Dispatch event
        event(new Registered($user));

        // Login the user
        Auth::login($user);

        // Redirect based on role
        if ($user->hasRole('admin')) {
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        } else {
            $this->redirect(route('welcome', absolute: false), navigate: true);
        }
    }
};
?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                wire:model="password" 
                id="password" 
                class="block mt-1 w-full pr-10" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password"
                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                title="Password harus minimal 8 karakter dan mengandung huruf serta angka." 
            />
            <button type="button" 
                onclick="togglePassword('password', 'eye-password', 'eye-slash-password')" 
                class="absolute inset-y-0 right-0 flex items-center px-3 mt-5 text-gray-500">
                <!-- Eye open -->
                <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M1.458 12C2.732 7.943 6.523 5 12 5s9.268 2.943 10.542 7c-1.274 4.057-5.065 7-10.542 7S2.732 16.057 1.458 12z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <!-- Eye slash -->
                <svg id="eye-slash-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M3.98 8.223a9.956 9.956 0 00-1.478 3.777C3.777 16.057 7.568 19 13.045 19a10.97 10.97 0 005.312-1.403m2.53-2.12A9.953 9.953 0 0022.53 12c-1.274-4.057-5.065-7-10.542-7-1.97 0-3.763.42-5.313 1.155M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input 
                wire:model="password_confirmation" 
                id="password_confirmation" 
                class="block mt-1 w-full pr-10" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
            />
            <button type="button" 
                onclick="togglePassword('password_confirmation', 'eye-confirm', 'eye-slash-confirm')" 
                class="absolute inset-y-0 right-0 flex items-center px-3 mt-5 text-gray-500">
                <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M1.458 12C2.732 7.943 6.523 5 12 5s9.268 2.943 10.542 7c-1.274 4.057-5.065 7-10.542 7S2.732 16.057 1.458 12z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <svg id="eye-slash-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M3.98 8.223a9.956 9.956 0 00-1.478 3.777C3.777 16.057 7.568 19 13.045 19a10.97 10.97 0 005.312-1.403m2.53-2.12A9.953 9.953 0 0022.53 12c-1.274-4.057-5.065-7-10.542-7-1.97 0-3.763.42-5.313 1.155M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- PIN -->
        <div class="mt-4 relative">
            <x-input-label for="pin" :value="__('PIN')" />
            <x-text-input 
                wire:model="pin" 
                id="pin" 
                class="block mt-1 w-full pr-10" 
                type="password" 
                name="pin" 
                required 
                inputmode="numeric" 
                pattern="[0-9]*" 
                minlength="6" 
                maxlength="6"
                autocomplete="off"
                placeholder="Masukkan 6 digit PIN"
            />
            <button type="button" 
                onclick="togglePassword('pin', 'eye-pin', 'eye-slash-pin')" 
                class="absolute inset-y-0 right-0 flex items-center px-3 mt-5 text-gray-500">
                <svg id="eye-pin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M1.458 12C2.732 7.943 6.523 5 12 5s9.268 2.943 10.542 7c-1.274 4.057-5.065 7-10.542 7S2.732 16.057 1.458 12z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <svg id="eye-slash-pin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M3.98 8.223a9.956 9.956 0 00-1.478 3.777C3.777 16.057 7.568 19 13.045 19a10.97 10.97 0 005.312-1.403m2.53-2.12A9.953 9.953 0 0022.53 12c-1.274-4.057-5.065-7-10.542-7-1.97 0-3.763.42-5.313 1.155M3 3l18 18" />
                </svg>
            </button>
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select wire:model="role" id="role" class="block mt-1 w-full" name="role" required>
                <option value="user">User</option>
                {{-- <option value="admin">Admin</option> --}}
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" 
                class="ms-4 px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                {{ __('Register') }}
            </button>
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