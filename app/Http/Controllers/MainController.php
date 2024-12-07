<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index() {
        echo 'im inside the app!';
    }

    public function newNote() {
        echo 'im creating a new note!';

    }

}
