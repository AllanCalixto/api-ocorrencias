<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
class TokenController extends Controller
{
    public function gerarToken (Request $request)
    {
        $this->validate($request, [
              'email' =>  'required|email',
              'password' =>  'required' 
            ]);

            $usuario = User::where('email', $request->email)->first();

            Hash::check($request->password, $usuario->password);

            if(is_null($usuario) || !Hash::check($request->password, $usuario->password)) {
                return response()->json(['error', 'Usuario ou senha invalidos'], Response::HTTP_NOT_FOUND);
            }



            $token = JWT::encode(['email' => '$request->email'], env('JWT_KEY'));

            return [
                'access_token' => $token
            ];
    }
}
