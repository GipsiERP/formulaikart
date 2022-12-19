<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'agencia',
        'conta',
        'contato_name',
        'contato_telefone',
        'contato_celular',
        'contato_email',
        'codigo',
        'status',
    ]; 
}
