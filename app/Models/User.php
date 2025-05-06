<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $fillable = [
        'username',
        'name',
        'password',
        'role',
    ];
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'userId', 'id');
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'userId', 'id');
    }
    public function koordinator()
    {
        return $this->hasOne(Koordinator::class, 'userId', 'id');
    }
    public function biro()
    {
        return $this->hasOne(Biro::class, 'userId', 'id');
    }

    public function judul()
    {
        return $this->hasMany(Judul::class, 'id_user', 'id');
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
    public function getIsMahasiswaAttribute()
    {
        return $this->role === 'mahasiswa';
    }
    public function getIsDosenOrKoordinatorAttribute()
    {
        return $this->role === 'dosen' || $this->role === 'koordinator';
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }
    public function isKoordinator()
    {
        return $this->role === 'koordinator';
    }
    public function isBiro()
    {
        return $this->role === 'biro';
    }

    public function getNamaKomentatorAttribute()
    {
        if ($this->dosen) {
            return $this->dosen->name;
        } elseif ($this->koordinator) {
            return $this->koordinator->name;
        }
        return 'Tidak diketahui';
    }
    public function getNamaUserAttribute()
    {
        return $this->dosen->name
            ?? $this->koordinator->name
            ?? $this->mahasiswa->name
            ?? $this->biro->name
            ?? 'Tidak diketahui';
    }
}
