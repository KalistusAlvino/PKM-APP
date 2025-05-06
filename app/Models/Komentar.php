<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'komentar';

    protected $fillable = [
        'id_judul',
        'id_user',
        'komentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user','id');
    }
    public function judul(){
        return $this->belongsTo(Judul::class,'id_judul','id');
    }
}
