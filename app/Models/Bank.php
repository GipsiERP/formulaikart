<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmBank extends Model
{
    use HasFactory, Notifiable, HasRoles, LogsActivity, SoftDeletes;
    
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
        'adm_client_id',
        'status',
    ];
}
