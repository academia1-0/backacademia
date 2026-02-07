<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planos extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'nome_plano',
        'valor_plano',
        'beneficios_plano',
        'qtd_alunos_plano'
    ];
}
