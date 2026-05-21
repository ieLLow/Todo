<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos.index');
    }

    public function create()
    {
        return view('todos.create');
    }

    public function show($id)
    {
        return view('todos.show');
    }

    public function edit($id)
    {
        return view('todos.edit');
    }
}
