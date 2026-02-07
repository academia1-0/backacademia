<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'data_nascimento',
        'endereco',
        'sexo',
        'formacao',
        'cargo',
        'salario',

    ];
    
}
