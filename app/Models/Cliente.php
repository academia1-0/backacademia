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
        'data_pagamento'
      
    ];

    //Função para converter data do formato brasileiro d/m/y para o formato que o BD aceita y-m-d
    // public function setDataNascimentoAttribute($value)
    //     {
    //         $this->attributes['data_nascimento'] =
    //             Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
           
    //     }
    public function setDataPagamentoAttribute($value)
        {
            $this->attributes['data_pagamento'] =
            Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        }


    //Para retornar no formato brasileiro ser apresentado no front
    public function getDataNascimentoAttribute($value)
    {
        return $value
            ? Carbon::parse($value)->format('d/m/Y')
            : null;
    }

    public function getDataPagamentoAttribute($value)
    {
        return $value
            ? Carbon::parse($value)->format('d/m/Y')
            : null;
    }
}
