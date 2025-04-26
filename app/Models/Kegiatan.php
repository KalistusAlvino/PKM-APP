<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'kegiatan';
    protected $fillable = [
        'id_jenis',
        'id_file',
        'id_kelompok',
        'id_mahasiswa',
        'nama_kegiatan',
        'kegiatan_inggris',
        'tanggal',
        'status'
    ];
    public function jenis(){
        return $this->belongsTo(Jenis::class,'id_jenis','id');
    }
    public function proposal(){
        return $this->belongsTo(ProposalFinal::class,'id_file','id');
    }
    public function kelompok(){
        return $this->belongsTo(Kelompok::class,'id_kelompok','id');
    }
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa','id');
    }
}
