<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
        $notes = User::find($id)->notes()->whereNull('deleted_at')->get()->toArray();



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
        $note = new Note(); // objeto criado a partir do model Note
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        //$id = $this->decryptId($id);
        $id = Operations::decryptId($id);

        // load note
        $note = Note::find($id);

        //show edit note view
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request){

        // validate request
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

        // check if note_id exists
        if ($request->note_id == null) {
            return redirect()->route('home');
        }
        // dcrypt note_id
        $id = Operations::decryptId($request->note_id);
        // load note
        $note = Note::find($id); // Note(model)::find(método stático extendido do Model)
        // update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();
        // redirect to home
        return redirect()->route('home');

    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        // load note
        $note = Note::find($id);

        // show delete note confirm
        return view('delete_note', ['note' => $note]);
    }

    public function deleteConfirm($id)
    {
        // check if id is encrypted
        $id = Operations::decryptId($id);
        // load note
        $note = Note::find($id);
        // 1. hard delete
        // $note->delete();

        // 2. soft delete
        $note->deleted_at = date('Y-m-d H:i:s');
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }
}
