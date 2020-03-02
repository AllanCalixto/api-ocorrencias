<?php
/**
 * Created by PhpStorm.
 * User: allan
 * Date: 01/02/2020
 * Time: 20:44
 */

namespace App\Http\Controllers;

use App\Ocorrencia;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OcorrenciasController
{
    public function index()
    {
       try {
           return Ocorrencia::all();
       } catch (QueryException $exception) {
           return response()->json(['erro' => 'Erro de Conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
       }
    }

    public function store(Request $request)
    {
        try {
            return response()->json(Ocorrencia::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'local' => $request->local,
                'tipo' => $request->tipo
            ], Response::HTTP_CREATED));
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de Conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
         $ocorrencia = Ocorrencia::find($id);
         if (is_null($ocorrencia)) {
             return response()->json(['Nao encontrado !'], Response::HTTP_NOT_FOUND);
         } else {
             try {
                 return response()->json($ocorrencia, Response::HTTP_FOUND);
             } catch (QueryException $exception) {
                 return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
             }
         }
    }

    public function update(int $id, Request $request)
    {
        try {
            $ocorrencia = Ocorrencia::find($id);
            $ocorrencia->fill($request->all());
            $ocorrencia->save();
            return response()->json(['$ocorrencia' => 'atualizada com sucesso !'], Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        $quantidadeDeOcorrenciasRemovidas = Ocorrencia::destroy($id);

        if ($quantidadeDeOcorrenciasRemovidas === 0) {
            return response()->json(['error' => 'Nao existe Ocorrencia para ser excluida'], Response::HTTP_NOT_FOUND);
        } else {
            try {
                return response()->json(['ok' => 'Ocorrencia excluida com sucesso '], Response::HTTP_NO_CONTENT);
            } catch (QueryException $exception) {
                return response()->json(['error' => 'Erro de conexao com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    }

}