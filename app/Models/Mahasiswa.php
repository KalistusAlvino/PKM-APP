<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    use HasUuids;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'userId',
        'name',
        'fakultas',
        'prodi',
        'email',
        'email_verification_token',
        'email_verification_at',
        'no_wa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function mahasiswaKelompok()
    {
        return $this->hasMany(MahasiswaKelompok::class,'mahasiswaId','id');
    }

    public function invite(){
        return $this->hasMany(Invite::class,'inviterId','id');
    }

}
