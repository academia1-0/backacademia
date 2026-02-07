<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Equipe;

class EquipeController extends Controller
{
    public function index()
    {
        return response()->json(Equipe::all());
    }

    //Cadastrar Equipe utilzando o store por convenção do laravel. Mas não é obrigatório
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email',
            'data_nascimento' => 'string',
            'endereco' => 'required|string|max:255',
            'sexo' => 'required|string|max:20',
            'formacao' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|string|max:20',
        ]);

 // Salvar os dados principais no banco de dados
    $equipes = new Equipe();

    $equipes->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' =>  $request->telefone, // Convertendo array para JSON
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'sexo' => $request->sexo,
            'formacao' => $request->formacao,
            'cargo' => $request->cargo,
            'salario' => $request->salario,
    ]);

    $equipes->save();


        // Retornar resposta de sucesso
        return response()->json([
            'mensagem' => 'Dados salvos com sucesso aqui!',
            'dados' => [
                'id' => $equipes->id,
                'nome' => $equipes->nome,
                'telefone' => $equipes->telefone, // Decodifica JSON armazenado
                'email' => $equipes->email,
                'data_nascimento' => $equipes->data_nascimento,
                'endereco' => $equipes->endereco,
                'sexo' => $equipes->sexo,
                'formacao' => $equipes->formacao,
                'cargo' => $equipes->cargo,
                'salario' => $equipes->salario,
            // 'images' => json_decode($dadosLanche->images, true)['base64'],
            ],
        ], 201);
    }

    public function show(string $id)
    {
       
    }

    //Atualizar dados do Funcionario
    public function update(Request $request, $id)
    {
        $equipes = Equipe::findOrFail($id);

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'email' => 'sometimes|required|email|unique:clientes,email,' . $equipes->id,
            'data_nascimento' => 'sometimes|required|string', //Tem que tratar a data de nascimento para tipo data (tava dando erro)
            'endereco' => 'sometimes|required|string|max:255',
            'sexo' => 'sometimes|required|string|max:20',
            'formacao' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|string|max:20',
        ]);

        //Atualiza apenas os campos enviados
        $equipes->update($request->all());

        //Retorna resposta json
        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'equipe' => $equipes
        ]);
    }

    //Deletar Clientes
    public function destroy(string $id)
    {
        $equipes = Equipe::findOrFail($id);
        $equipes ->delete();

        return response()->json(['message' => 'Funcionário removido com sucesso']);

        
    }
}
