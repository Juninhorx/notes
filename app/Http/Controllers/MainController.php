<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
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
        // Show new note view
        return view('new_note');
    }

    public function newNoteSubmit(Request $request) {

        //validade request
        $request->validate(
            //rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //messages
            [
                'text_title.required' => 'O Título é obrigatório',
                'text_title.min' => 'O Título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O Título deve ter no máximo :max caracteres',
                'text_note.required' => 'A Nota é obrigatória',
                'text_note.min' => 'A Nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A Nota deve ter no máximo :max caracteres'
            ]
        );

        //get user id
        $id = session('user.id');

        //create new note

        //redirect to home
    }

    public function editNote($id)
    {

        //$id = $this->decryptId($id);
        $id = Operations::decryptId($id);
        echo "im editing note with id = $id";
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        echo "im deleting note with id = $id";
    }
}
