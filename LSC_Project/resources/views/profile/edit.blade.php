@extends('layouts.customer')

@section('title', 'Profil Saya')

@section('content')

{{-- ── Header ──────────────────────────────────────────────────── --}}
<header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="font-grotesk font-black uppercase tracking-tighter" style="font-size: clamp(1.8rem, 4vw, 2.8rem);">
            Profil Saya
        </h1>
        <p class="text-on-surface-variant text-base mt-1">Kelola informasi akun dan atur kata sandi Anda.</p>
    </div>
</header>

@if(session('status') === 'profile-updated')
    <div class="mb-6 text-white px-5 py-4 font-bold border-[3px] border-stroke flex items-center gap-3"
         style="background-color:#16a34a; box-shadow:4px 4px 0px #000;">
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
        Profil berhasil diperbarui.
    </div>
@endif

@if(session('status') === 'avatar-updated')
    <div class="mb-6 text-white px-5 py-4 font-bold border-[3px] border-stroke flex items-center gap-3"
         style="background-color:#16a34a; box-shadow:4px 4px 0px #000;">
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
        Foto profil berhasil diperbarui.
    </div>
@endif

@if(session('status') === 'password-updated')
    <div class="mb-6 text-white px-5 py-4 font-bold border-[3px] border-stroke flex items-center gap-3"
         style="background-color:#16a34a; box-shadow:4px 4px 0px #000;">
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">check_circle</span>
        Kata sandi berhasil diperbarui.
    </div>
@endif

{{-- Banner: profil belum lengkap (dari middleware atau session) --}}
@php
    $missingPhone   = empty(auth()->user()->phone);
    $missingAddress = empty(auth()->user()->address);
    $isIncomplete   = $missingPhone || $missingAddress;
@endphp

@if(session('incomplete_profile') || $isIncomplete)
    <div id="incomplete-profile-banner"
         class="mb-8 border-[3px] border-[#ef4444] p-5 flex gap-4 items-start"
         style="background-color:#fff0f0; box-shadow: 6px 6px 0px 0px #ef4444;">
        <span class="material-symbols-outlined text-3xl mt-0.5 shrink-0" style="color:#dc2626;">warning</span>
        <div class="flex-1">
            <p class="font-grotesk font-black uppercase text-base mb-1" style="color:#dc2626;">
                Lengkapi Profil untuk Melakukan Pemesanan
            </p>
            <p class="text-sm font-semibold" style="color:#7f1d1d;">
                Anda belum mengisi
                @if($missingPhone && $missingAddress)
                    <strong>Nomor Telepon</strong> dan <strong>Alamat Lengkap</strong>
                @elseif($missingPhone)
                    <strong>Nomor Telepon</strong>
                @else
                    <strong>Alamat Lengkap</strong>
                @endif.
                Silakan lengkapi informasi di bawah ini sebelum melakukan pemesanan.
            </p>
        </div>
    </div>
@endif

{{-- ── Foto Profil ─────────────────────────────────────────────── --}}
<div class="neo-card bg-white p-6 md:p-8 mb-8">
    <h2 class="font-grotesk font-bold text-xl uppercase mb-6 border-b-[3px] border-stroke pb-4 flex items-center gap-2">
        <span class="material-symbols-outlined">account_circle</span>
        Foto Profil
    </h2>
    <div class="flex items-center gap-6">
        {{-- Preview Avatar --}}
        <div class="shrink-0">
            @if($user->getAvatarUrl())
                <img src="{{ $user->getAvatarUrl() }}"
                     alt="Foto profil"
                     id="avatar-preview"
                     class="w-24 h-24 rounded-full object-cover border-[3px] border-stroke">
            @else
                {{-- Placeholder anonim --}}
                <div id="avatar-preview-placeholder"
                     class="w-24 h-24 rounded-full border-[3px] border-stroke overflow-hidden flex items-end justify-center"
                     style="background-color: #e2e8f0;">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" style="color:#94a3b8;">
                        <circle cx="50" cy="36" r="20" fill="currentColor"/>
                        <ellipse cx="50" cy="85" rx="34" ry="22" fill="currentColor"/>
                    </svg>
                </div>
            @endif
        </div>

        <div class="flex-1">
            <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" id="avatar-form">
                @csrf
                <label for="avatar-input"
                       class="neo-btn-primary cursor-pointer inline-flex items-center gap-2 py-3 px-5 font-bold uppercase text-sm">
                    <span class="material-symbols-outlined text-base">upload</span>
                    Pilih Foto
                </label>
                <input id="avatar-input" name="avatar" type="file"
                       accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="hidden"
                       onchange="previewAndUploadAvatar(this)">

                @error('avatar')
                    <p class="text-danger font-bold text-sm mt-3">{{ $message }}</p>
                @enderror
                <p class="text-xs text-on-surface-variant mt-3">Format: JPG, PNG, WebP &middot; Maks. 2 MB. Foto tersimpan otomatis setelah dipilih.</p>
            </form>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.2fr_1fr] gap-8">
    {{-- Update Profile Info --}}
    <div class="neo-card bg-white p-6 md:p-8">
        <h2 class="font-grotesk font-bold text-xl uppercase mb-6 border-b-[3px] border-stroke pb-4">Informasi Profil</h2>
        
        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block font-bold text-on-surface mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="w-full border-[3px] border-stroke px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')<div class="text-error font-bold text-sm mt-2">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="email" class="block font-bold text-on-surface mb-2">Email</label>
                <input type="email" id="email" class="w-full border-[3px] border-stroke px-4 py-3 bg-surface opacity-60 cursor-not-allowed select-none" value="{{ $user->email }}" disabled>
                <p class="text-xs text-on-surface-variant mt-1">Email tidak dapat diubah.</p>
            </div>

            <div>
                <label for="phone" class="block font-bold text-on-surface mb-2">
                    Nomor Telepon
                    @if($missingPhone)
                        <span class="text-danger font-black">*</span>
                        <span class="text-xs font-semibold text-danger ml-1">(Wajib diisi)</span>
                    @endif
                </label>
                <input type="text" id="phone" name="phone"
                    class="w-full border-[3px] px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors
                           {{ $missingPhone ? 'border-[#ef4444]' : 'border-stroke' }}"
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Contoh: 08123456789">
                @error('phone')<div class="text-error font-bold text-sm mt-2">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="address" class="block font-bold text-on-surface mb-2">
                    Alamat Lengkap
                    @if($missingAddress)
                        <span class="text-danger font-black">*</span>
                        <span class="text-xs font-semibold text-danger ml-1">(Wajib diisi)</span>
                    @endif
                </label>
                <textarea id="address" name="address"
                    class="w-full border-[3px] px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors
                           {{ $missingAddress ? 'border-[#ef4444]' : 'border-stroke' }}"
                    rows="3"
                    placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
                @error('address')<div class="text-error font-bold text-sm mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="neo-btn-primary w-full py-4 font-black uppercase tracking-wide flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-col gap-8">
        {{-- Update Password --}}
        <div class="neo-card bg-surface-container-low p-6 md:p-8">
            <h2 class="font-grotesk font-bold text-xl uppercase mb-6 border-b-[3px] border-stroke pb-4">Ubah Kata Sandi</h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block font-bold text-on-surface mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="w-full border-[3px] border-stroke px-4 py-3 bg-white focus:outline-none focus:ring-0 focus:border-primary transition-colors" required>
                    @if($errors->updatePassword->has('current_password'))
                        <div class="text-error font-bold text-sm mt-2">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div>
                    <label for="password" class="block font-bold text-on-surface mb-2">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="w-full border-[3px] border-stroke px-4 py-3 bg-white focus:outline-none focus:ring-0 focus:border-primary transition-colors" required>
                    @if($errors->updatePassword->has('password'))
                        <div class="text-error font-bold text-sm mt-2">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <div>
                    <label for="password_confirmation" class="block font-bold text-on-surface mb-2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border-[3px] border-stroke px-4 py-3 bg-white focus:outline-none focus:ring-0 focus:border-primary transition-colors" required>
                    @if($errors->updatePassword->has('password_confirmation'))
                        <div class="text-error font-bold text-sm mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="neo-btn-primary w-full py-4 font-black uppercase tracking-wide flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">lock_reset</span>
                        Perbarui Sandi
                    </button>
                </div>
            </form>
        </div>

        {{-- Delete Account --}}
        <div class="neo-card p-6 md:p-8" style="background-color: #fee2e2; border-color: #ef4444;">
            <div class="flex items-center gap-3 border-b-[3px] border-error pb-4 mb-4">
                <span class="material-symbols-outlined text-error text-3xl font-black">warning</span>
                <h2 class="font-grotesk font-black text-xl text-error uppercase">Hapus Akun</h2>
            </div>
            
            <p class="text-error-container text-sm font-bold mb-6 leading-relaxed" style="color: #991b1b;">
                Setelah akun dihapus, semua data dan informasi yang tersimpan akan hilang secara permanen.
            </p>
            
            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun secara permanen? Masukkan kata sandi Anda untuk mengonfirmasi.')">
                @csrf
                @method('delete')
                
                <div class="mb-6">
                    <label for="delete_password" class="block font-black text-error mb-2 uppercase text-sm tracking-wider">Sandi Konfirmasi</label>
                    <input type="password" id="delete_password" name="password" class="w-full border-[3px] border-error px-4 py-3 bg-white focus:outline-none focus:ring-0" required placeholder="Masukkan sandi Anda">
                    @if($errors->userDeletion->has('password'))
                        <div class="text-error font-bold text-sm mt-2">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>
                
                <button type="submit" class="neo-btn-danger w-full py-4 font-black uppercase tracking-wide flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">delete_forever</span>
                    Hapus Akun Permanen
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewAndUploadAvatar(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const prev = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-preview-placeholder');
        if (prev) {
            prev.src = e.target.result;
        } else if (placeholder) {
            placeholder.outerHTML = `<img id="avatar-preview" src="${e.target.result}"
                class="w-24 h-24 rounded-full object-cover border-[3px] border-stroke">`;
        }
    };
    reader.readAsDataURL(input.files[0]);
    document.getElementById('avatar-form').submit();
}
</script>
@endsection

