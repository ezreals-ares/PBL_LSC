@extends('layouts.customer')

@section('title', 'Profil Saya')

@section('extra-styles')
<style>
    .profile-header {
        margin-bottom: 2rem;
    }
    .profile-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
    }
    .profile-subtext {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 992px) {
        .profile-grid {
            grid-template-columns: 1.2fr 1fr;
        }
    }
    .btn-danger {
        background: #ef4444;
        color: white;
        border: none;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3);
    }
    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="profile-header">
    <h1>Profil Saya</h1>
    <p class="profile-subtext">Kelola informasi akun dan atur kata sandi Anda.</p>
</div>

@if(session('status') === 'profile-updated')
    <div class="flash-toast flash-success" id="flash-msg">
        <span>✓</span> Profil berhasil diperbarui.
    </div>
@endif

@if(session('status') === 'password-updated')
    <div class="flash-toast flash-success" id="flash-msg">
        <span>✓</span> Kata sandi berhasil diperbarui.
    </div>
@endif

<div class="profile-grid">
    {{-- Update Profile Info --}}
    <div class="card">
        <div class="section-heading">Informasi Profil</div>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
                @error('phone')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
                @error('address')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Profil</button>
        </form>
    </div>

    <div>
        {{-- Update Password --}}
        <div class="card" style="margin-bottom: 2rem;">
            <div class="section-heading">Ubah Kata Sandi</div>
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                    @if($errors->updatePassword->has('current_password'))
                        <div class="form-error">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @if($errors->updatePassword->has('password'))
                        <div class="form-error">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    @if($errors->updatePassword->has('password_confirmation'))
                        <div class="form-error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Sandi</button>
            </form>
        </div>

        {{-- Delete Account --}}
        <div class="card" style="border-color: #fecaca; background: #fef2f2;">
            <div class="section-heading" style="color: #dc2626;">Hapus Akun</div>
            <p style="font-size: 0.9rem; color: #991b1b; margin-bottom: 1.5rem;">
                Setelah akun dihapus, semua data dan informasi yang tersimpan akan hilang secara permanen.
            </p>
            
            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun secara permanen? Masukkan kata sandi Anda untuk mengonfirmasi.')">
                @csrf
                @method('delete')
                <div class="form-group">
                    <label for="delete_password" class="form-label" style="color: #dc2626;">Kata Sandi</label>
                    <input type="password" id="delete_password" name="password" class="form-control" required placeholder="Masukkan sandi untuk konfirmasi" style="border-color: #fca5a5; background: white;">
                    @if($errors->userDeletion->has('password'))
                        <div class="form-error">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-danger">Hapus Akun Permanen</button>
            </form>
        </div>
    </div>
</div>
@endsection
