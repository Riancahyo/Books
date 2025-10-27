<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Helpers\SimpleEncryption;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $hiddenPassword = '********';
    public bool $showPinInput = false;
    public string $pin = '';

    public function mount(): void
    {
        $user = Auth::user();

        // ✅ Dekripsi nama sebelum ditampilkan
        try {
            $this->name = SimpleEncryption::decrypt($user->name, $user->pin);
        } catch (\Exception $e) {
            $this->name = $user->name;
        }

        $this->email = $user->email;
    }

    public function showPinField()
    {
        $this->showPinInput = true;
    }

    public function revealPassword()
    {
        $user = Auth::user();

        if (empty($this->pin)) {
            $this->dispatch('alert', message: 'Masukkan PIN terlebih dahulu!');
            return;
        }

        try {
            $decrypted = SimpleEncryption::decrypt($user->password, $this->pin);
            $this->hiddenPassword = $decrypted;
            $this->showPinInput = false;
        } catch (\Exception $e) {
            $this->dispatch('alert', message: 'PIN salah atau gagal dekripsi!');
        }
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        try {
            $validated['name'] = SimpleEncryption::encrypt($validated['name'], $user->pin);
        } catch (\Exception $e) {
            $validated['name'] = $validated['name'];
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
};
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- 🔒 Password Field -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="text" wire:model="hiddenPassword" readonly class="mt-1 block w-full bg-gray-100" />
            
            <button type="button" wire:click="showPinField" class="mt-2 text-sm text-blue-600 underline">
                {{ __('Lihat Password') }}
            </button>

            @if ($showPinInput)
                <div class="mt-2 space-y-2">
                    <x-text-input type="password" wire:model="pin" placeholder="Masukkan PIN Anda" class="block w-full border-gray-300 rounded-md" />
                    <button type="button" wire:click="revealPassword" class="px-3 py-1 bg-blue-600 text-white rounded">
                        {{ __('Konfirmasi PIN') }}
                    </button>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md 
                    font-semibold text-xs text-white uppercase tracking-widest 
                    hover:bg-green-700 focus:bg-green-700 active:bg-green-800 
                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>

    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('alert', data => alert(data.message));
        });
    </script>
</section>
