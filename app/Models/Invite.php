<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'invite_dospem';

    protected $fillable = [
        'inviterId',
        'dospemId',
        'kelompokId',
        'status'
    ];

    public function inviter()
    {
        return $this->belongsTo(Mahasiswa::class,'inviterId','id');
    }

    public function kelompok(){
        return $this->belongsTo(Kelompok::class,'kelompokId','id');
    }



}
