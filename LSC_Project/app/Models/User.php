<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function canAccessPanel(Panel $panel): bool
    {

        if ($panel->getId() === 'admin') {
            return $this->role === 'admin';
        }

        if ($panel->getId() === 'customer') {
            return $this->role === 'customer';
        }

        return false;
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'google_id',
        'avatar',
    ];

    /**
     * Mengembalikan URL avatar:
     * - Jika user Google: URL langsung dari Google
     * - Jika upload lokal: asset storage
     * - Jika tidak ada: null (tampilkan inisial nama)
     */
    public function getAvatarUrl(): ?string
    {
        if (!$this->avatar) return null;

        // Avatar dari Google adalah URL lengkap
        if (str_starts_with($this->avatar, 'http')) {
            return $this->avatar;
        }

        // Avatar lokal tersimpan di storage
        return asset('storage/' . $this->avatar);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}