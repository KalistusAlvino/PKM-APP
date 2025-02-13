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
        return $this->hasOne(Mahasiswa::class);
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}
