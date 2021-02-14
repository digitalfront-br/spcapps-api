<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Validator};

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'  =>  'required|email',
            'password'  =>  'required|min:6'
        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email precisa ser válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha tem pelo menos 6 caracteres',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['email' => ['Email não cadastrado']], 400);
        } else {
            if (Hash::check($request->password, $user->password)) {
            } else {
                return response()->json(['password' => ['Senha incorreta']], 400);
            }
        }
        return response()->json(new UserResource($user), 200);
    }

    public function createAccount(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'      =>  'required|min:3',
            'email'     =>  'required|email',
            'phone'     =>  'required|min:11',
            'password'  =>  'required|min:6'
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min'      => 'O nome precisa de pelo menos 3 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email'   => 'O email precisa ser válido',
            'phone.required' => 'O telefone é obrigatório',
            'phone.min'     => 'O telefone precisa de pelo menos 11 caracteres',
            'password.min'  => 'A senha tem pelo menos 6 caracteres',
            'password.required' => 'A senha é obrigatória',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $findUser = User::where('email', $request->email)->first();

        if ($findUser) {
            return response()->json(['email' => ['Email já esta cadastrado']], 200);
        } else {
            $user = new User;

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->token = $user->createToken('user-token')->plainTextToken;

            return response()->json(new UserResource($user), 201);
        }
    }

    public function forgotPassword()
    {
        return response()->json('recuperar senha', 200);
    }
}