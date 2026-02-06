<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        //return Cliente::all();
        return response()->json(Cliente::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'string',
            'endereco' => 'required|string|max:255',
            'sexo' => 'required|string|max:20',
        ]);

        //$cliente = Cliente::create($request->all());
 // Salvar os dados principais no banco de dados
    $cliente = new Cliente();
        //return response()->json($cliente, 201);

        $cliente->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' =>  $request->telefone, // Convertendo array para JSON
            'data_nascimento' => $request->data_nascimento,
            'endereco' => $request->endereco,
            'sexo' => $request->sexo,
        ]);

        $cliente->save();


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
            // 'images' => json_decode($dadosLanche->images, true)['base64'],
            ],
        ], 201);
    }

    public function show(string $id)
    {
        //return response()->json(Cliente::findOrFail($id));
        // $cliente = Cliente::find($id);

        // if ($cliente) {
        //     $cliente->delete();
        //     return response()->json(['message' => 'Registro deletado com sucesso!'], 200);
        // }
        // return response()->json(['message' => 'Registro não encontrado!'], 404);
    }

    public function update(Request $request, $id)
    {
        // $cliente = Cliente::findOrFail($id);

        // $request->validate([
        //     'nome' => 'sometimes|required|string|max:255',
        //     'email' => 'sometimes|required|email|unique:clientes,email,' . $cliente->id,
        //     'telefone' => 'nullable|string|max:20',
        //     'data_nascimento' => 'sometimes|required|date',
        //     'endereco' => 'sometimes|required|string|max:255',
        //     'sexo' => 'sometimes|required|string|max:20',
        // ]);

        // $cliente->update($request->all());

        // return response()->json($cliente);
    }

    public function destroy(string $id)
    {
        // $cliente = Cliente::findOrFail($id);
        // $cliente->delete();

        // return response()->json(['message' => 'Cliente removido com sucesso']);
    }
}
