<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judul extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'judul';

    protected $fillable = [
        'id_kelompok',
        'id_user',
        'detail_judul',
        'id_skema',
        'keterangan'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user','id');
    }

    public function skema()
    {
        return $this->belongsTo(SkemaPkm::class,'id_skema','id');
    }
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_judul', 'id')->orderBy('created_at','desc');
    }

    public function proposal() {
        return  $this->hasOne(ProposalFinal::class, 'judulId','id');
    }
}
