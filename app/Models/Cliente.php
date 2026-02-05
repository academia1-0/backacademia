<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
     use HasFactory, Notifiable, SoftDeletes;
     protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'endereco',
        'sexo'
      
    ];
}
