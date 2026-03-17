<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Show Todo App UI
     */
    public function index()
    {
        return view('todo');
    }
}
