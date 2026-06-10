<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- ── Upload Foto Profil ─────────────────────────────── --}}
    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Foto Profil</h3>

        <div class="flex items-center gap-5">
            {{-- Preview Avatar --}}
            <div class="shrink-0">
                @if($user->getAvatarUrl())
                    <img src="{{ $user->getAvatarUrl() }}"
                         alt="Foto profil {{ $user->name }}"
                         id="avatar-preview"
                         class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 dark:border-gray-500">
                @else
                    <div id="avatar-preview-placeholder"
                         class="w-20 h-20 rounded-full bg-blue-600 border-2 border-gray-300 flex items-center justify-center text-white font-bold text-2xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            {{-- Upload Form --}}
            <div class="flex-1">
                @if($user->google_id && str_starts_with($user->avatar ?? '', 'http'))
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                        <!-- <span class="inline-flex items-center gap-1">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12 12-5.373 12-12S18.628 0 12 0zm6.804 16.636c-.27.404-.664.665-1.116.735l-.02.003c-.417.057-.855-.032-1.205-.249l-3.466-2.117-1.977 1.905a.297.297 0 01-.42-.005l-.003-.003-.413-4.267 6.352-5.822c.27-.247.063-.621-.278-.485L6.862 12.64 3.522 11.61c-.77-.24-.78-1.065-.106-1.356l13.335-5.142c.635-.244 1.215.354.982.992l-1.929 11.532z"/></svg>
                            Menggunakan foto dari akun Google
                        </span> -->
                    </p>
                @endif

                <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" id="avatar-form">
                    @csrf
                    <label for="avatar-input"
                           class="cursor-pointer inline-flex items-center gap-2 px-3 py-2 text-sm font-medium bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Pilih Foto
                    </label>
                    <input id="avatar-input" name="avatar" type="file"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           class="hidden"
                           onchange="previewAvatar(this); document.getElementById('avatar-form').submit();">

                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">JPG, PNG, WebP · Maks. 2 MB</p>

                    @if (session('status') === 'avatar-updated')
                        <p class="text-sm text-green-600 dark:text-green-400 mt-1 font-medium">Foto profil berhasil diperbarui.</p>
                    @endif

                    @error('avatar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </div>

    {{-- ── Info Akun ─────────────────────────────────────── --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const prev = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-preview-placeholder');
            if (prev) prev.src = e.target.result;
            if (placeholder) {
                placeholder.innerHTML = `<img src="${e.target.result}" class="w-20 h-20 rounded-full object-cover">`;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
