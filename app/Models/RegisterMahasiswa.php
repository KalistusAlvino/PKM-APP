<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterMahasiswa extends Model
{
    use HasFactory;

    public function __construct(public User $user, public Mahasiswa $mahasiswa, public Kelompok $kelompok, public MahasiswaKelompok $mahasiswaKelompok)
    {
    }
}
