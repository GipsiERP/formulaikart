<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finances extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'data',
        'number',
        'due',
        'value',
        'due_pay',
        'value_pay',
        'driver_id',
        'event_id',
        'finished',
        'descricao',
        'bank_id',
    ];
    
}
