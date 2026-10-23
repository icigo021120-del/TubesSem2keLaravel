<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use StampsOnCreate;

    protected string $stampColumn = 'created_at';

    public $timestamps = false;

    protected $authPasswordName = 'password_hash';

    protected $fillable = ['nama_lengkap', 'email', 'no_telepon', 'role', 'password_hash'];

    protected $hidden = ['password_hash'];

    protected $casts = ['created_at' => 'datetime'];

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Aplikasi ini tanpa authentication, jadi "pengguna aktif" diambil
     * dari akun non-admin pertama, dan "admin aktif" dari akun admin pertama.
     */
    /** Akun yang sedang login (dari session). */
    public static function current(): ?self
    {
        $id = session('user_id');

        return $id ? static::find($id) : null;
    }

    public static function pengguna(): ?self
    {
        return static::current();
    }

    public static function admin(): ?self
    {
        return static::current();
    }
}
