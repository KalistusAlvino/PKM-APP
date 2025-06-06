<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterAnggota extends Model
{
    use HasFactory;

    public function __construct(public User $user, public Mahasiswa $mahasiswa, public MahasiswaKelompok $mahasiswaKelompok)
    {
    }
}
