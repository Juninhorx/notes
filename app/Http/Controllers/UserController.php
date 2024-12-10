<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function singIn()
    {
        return view('singin');
    }

    public function singInSubmit(Request $request)
    {
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

        // get username and password
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // check if user exists
        $user = User::where('username', $username)->where('deleted_at', NULL)->first();

        if ($user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('singInError', 'Este usuário ja existe!.');
        }

        $newUser = new User();
        $newUser->username = $username;
        $newUser->password = bcrypt($password);
        $newUser->save();

        return redirect()->route('login');



    }
}
