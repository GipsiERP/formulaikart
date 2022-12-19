<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'data',
        'horario',
        'track_id',
        'championships_id',
        'fee_value',
        'finished',
        'points_versao',
        'status',
    ];

}