<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        //return Cliente::all();
        return response()->json(Cliente::all());
    }

    //Cadastrar cliente utilzando o store por convenção do laravel. Mas não é obrigatório
    public function store(Request $request)
    {
        $validator= validator::make($request->all(),[ //usando o ::make() para controlar a resposta.
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date_format:Y-m-d',
            'endereco' => 'required|string|max:255',
            'sexo' => 'nullable|string|max:20',
            'pagamento' => 'required|boolean',
            'data_pagamento' => 'nullable|date_format:d/m/Y',
            'plano' => 'nullable|string|max:20'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'erro',
                'mensagem'=> 'Erro de validação',
                'erros'=>$validator->errors()
            ],422);
        }

        // Salvar os dados principais no banco de dados
        $cliente = Cliente::create($request->all());//Estou usando dessa forma porque estou utilizando MUTATOR para converter data la na model 
 
        $cliente->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' =>  $request->telefone, 
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'sexo' => $request->sexo,
            'pagamento' => $request->pagamento,
            'data_pagamento'=>$request->data_pagamento,
            'plano'=>$request->plano
        ]);


        // Retornar resposta de sucesso
        return response()->json([
            'mensagem' => 'Dados salvos com sucesso aqui!',
            'dados' => [
                'id' => $cliente->id,
                'nome' => $cliente->nome,
                'email' => $cliente->email,
                'telefone' => $cliente->telefone, // Decodifica JSON armazenado
                'data_nascimento' => $cliente->data_nascimento,
                'endereco' => $cliente->endereco,
                'sexo' => $cliente->sexo,
                'pagamento' => $cliente->pagamento,
                'data_pagamento' => $cliente->data_pagamento,
                'plano' => $cliente->plano
            // 'images' => json_decode($dadosLanche->images, true)['base64'],
            ],
        ], 201);
    }

    //Mostrar um cliente em especifico
    public function show(string $id)
    {
        return response()->json(Cliente::findOrFail($id));
    }

    //Atualizar dados do cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'sometimes|required|string', //Tem que tratar a data de nascimento para tipo data (tava dando erro)
            'endereco' => 'sometimes|required|string|max:255',
            'sexo' => 'sometimes|required|string|max:20',
            'pagamento' => 'required|boolean',
            'data_pagamento' => 'nullable|string|max:20',
            'plano' => 'sometimes|string|max:50'
        ]);

        //Atualiza apenas os campos enviados
        $cliente->update($request->all());

        //Retorna resposta json
        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'cliente' => $cliente
        ]);
    }

    //Deletar Clientes
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json(['message' => 'Cliente removido com sucesso']);

        
    }
}
