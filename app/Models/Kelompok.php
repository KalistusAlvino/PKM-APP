<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'kelompok';

    protected $fillable = [
        'dospemId'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dospemId', 'id');
    }

    public function mahasiswaKelompok()
    {
        return $this->hasMany(MahasiswaKelompok::class, 'kelompokId', 'id');
    }

    public function invite()
    {
        return $this->hasMany(Invite::class, 'kelompokId', 'id');
    }

    public function judul()
    {
        return $this->hasMany(Judul::class, 'id_kelompok', 'id');
    }

    public function getNamaKetua(){
        return $this->mahasiswaKelompok->firstWhere('status_mahasiswa', 'ketua')?->mahasiswa->name;
    }

    protected static function booted()
    {
        static::deleting(function ($kelompok) {
            $kelompok->mahasiswaKelompok()->delete();
            foreach ($kelompok->judul as $judul) {
                $judul->proposal()?->delete(); // hapus proposal jika ada
                $judul->delete(); // hapus judul
            }
        });
    }
}
