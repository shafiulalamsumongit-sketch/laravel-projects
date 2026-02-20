<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show Todo App UI
     */
    public function index()
    {
        return view('todo');
    }
}
