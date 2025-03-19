<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalFinal extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'proposal_final';

    protected $fillable = [
        'judulId',
        'nama_file',
    ];

    public function judul(){
        return $this->belongsTo(Judul::class,'judulId','id');
    }
}
