<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drivers extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'apelido',
        'cpf',
        'rg',
        'dn',
        'telefone',
        'celular',
        'email',
        'status',
        'nickname_math',
    ]; 
}
