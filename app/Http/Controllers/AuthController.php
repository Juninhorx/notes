<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validation
        $request->validate(
            //rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            //messages
            [
                'text_username.required' => 'O usuário é obrigatório',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'A senha é obrigatória',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres'
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // get all the users from database

        // diretamente
        // $users = User::all()->toArray();

        // como instância da classe User
        $UserModel = new User();
        $users = $UserModel->all()->toArray();

        echo '<pre>';
        print_r($users);
    }

    public function logout()
    {
        echo 'logout';

    }
}
