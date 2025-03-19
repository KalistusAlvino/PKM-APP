<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaPkm extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'skema_pkm';

    protected $fillable = [
        'nama_skema'
    ];

    public function judul()
    {
        return $this->hasMany(Judul::class,'id_skema','id');
    }
}
