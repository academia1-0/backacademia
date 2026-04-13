<?php

namespace App\Models;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

//Usado para converter datas
use Carbon\Carbon;
class Cliente extends Model
{
     use HasFactory;
     protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'endereco',
        'sexo',
        'pagamento',
        'data_pagamento',
        'plano'
      
    ];

    protected $casts = [
        'data_nascimento' => 'date',
       
    
    ];

    
}
