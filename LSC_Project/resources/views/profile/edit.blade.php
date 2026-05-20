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
    <div class="mb-6 bg-success text-white px-5 py-4 font-bold border-[3px] border-stroke neo-shadow-sm flex items-center gap-3">
        <span class="material-symbols-outlined">check_circle</span>
        Profil berhasil diperbarui.
    </div>
@endif

@if(session('status') === 'password-updated')
    <div class="mb-6 bg-success text-white px-5 py-4 font-bold border-[3px] border-stroke neo-shadow-sm flex items-center gap-3">
        <span class="material-symbols-outlined">check_circle</span>
        Kata sandi berhasil diperbarui.
    </div>
@endif

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
                <input type="email" id="email" name="email" class="w-full border-[3px] border-stroke px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="text-error font-bold text-sm mt-2">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="phone" class="block font-bold text-on-surface mb-2">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" class="w-full border-[3px] border-stroke px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
                @error('phone')<div class="text-error font-bold text-sm mt-2">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="address" class="block font-bold text-on-surface mb-2">Alamat Lengkap</label>
                <textarea id="address" name="address" class="w-full border-[3px] border-stroke px-4 py-3 bg-surface focus:outline-none focus:ring-0 focus:border-primary transition-colors" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
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
