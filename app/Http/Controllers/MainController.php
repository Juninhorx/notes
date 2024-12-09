<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{

    public function index()
    {

        // load user's notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();



        // show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo 'im creating a new note!';
    }

    public function editNote($id)
    {
        try {
            //code...
            $id = Crypt::decrypt($id);
            echo $id;
        } catch (DecryptException $e) {

            return redirect()->route('home');
        }
        echo "im editing note with id = $id";
    }

    public function deleteNote($id)
    {
        try {
            //code...
            $id = Crypt::decrypt($id);
            echo $id;
        } catch (DecryptException $e) {

            return redirect()->route('home');
        }
        echo "im deleting note with id = $id";
    }


}
