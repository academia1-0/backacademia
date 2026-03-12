<?php

namespace App\Http\Controllers;

use App\Models\Planos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanosController extends Controller
{
    public function index()
    {
        return response()->json(Planos::all());
    }

    //Cadastrar Equipe utilzando o store por convenção do laravel. Mas não é obrigatório
    public function store(Request $request)
    {
      //dd($request->all(), $request->file('imagem_plano'));
        $request->validate([
            'nome_plano' => 'required|string|max:255',
            'valor_plano' => 'required|string|max:20',
            'beneficios_plano' => 'required|string|max:255',
            'qtd_alunos_plano' => 'required|string|max:20',
            'imagem_plano' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        //Convertendo imagem para base64
        $caminhoImagem = null;

        if ($request->hasFile('imagem_plano')) {
        
            $imagem = $request->file('imagem_plano');
        
            $caminhoImagem = $imagem->store('planos', 'public');
        
        }
       
    
       
 // Salvar os dados principais no banco de dados
    $plano = new Planos();

    $plano->fill([
            'nome_plano' => $request->nome_plano,
            'valor_plano' => $request->valor_plano,
            'beneficios_plano' =>  $request->beneficios_plano, // Convertendo array para JSON
            'qtd_alunos_plano' => $request->qtd_alunos_plano,
            'imagem_plano' => $caminhoImagem
    ]);
    $plano->imagem_plano = $caminhoImagem;
    $plano->save();


        // Retornar resposta de sucesso
        return response()->json([
            'mensagem' => 'Dados salvos com sucesso!',
            'dados' => [
                'id' => $plano->id,
                'nome_plano' => $plano->nome_plano,
                'valor_plano' => $plano->valor_plano,
                'beneficios_plano' => $plano->beneficios_plano,
                'qtd_alunos_plano' => $plano->qtd_alunos_plano,
                'imagem_plano' => $plano->imagem_plano
                    ? asset('storage/' . $plano->imagem_plano)
                    : null
            ]
        ], 201);
    }

    public function show(string $id)
    {
       
    }

    //Atualizar dados do Funcionario
    public function update(Request $request, $id)
    {
        $plano = Planos::findOrFail($id);

        $request->validate([
           'nome_plano' => 'required|string|max:255',
            'valor_plano' => 'required|string|max:20',
            'beneficios_plano' => 'required|string|max:255',
            'qtd_alunos_plano' => 'required|string|max:20'
            
        ]);

        //Atualiza apenas os campos enviados
        $plano->update($request->all());

        //Retorna resposta json
        return response()->json([
            'message' => 'Plano atualizado com sucesso',
            'equipe' => $plano
        ]);
    }

    //Deletar Clientes
    public function destroy(string $id)
    {
        $plano = Planos::findOrFail($id);
        $plano ->delete();

        return response()->json(['message' => 'Plano removido com sucesso']);

        
    }
}
