<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRaffles extends Model
{
    use HasFactory;

    protected $fillable = [
        'posicao',
        'driver_id',
        'event_id',
        'categoria_id'
    ];

}
