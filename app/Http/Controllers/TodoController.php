<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $doneCount = Todo::query()->whereNotNull('completed_at')->count();

        return view('todos.index', ['todos' => $todos, 'doneCount' => $doneCount]);
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

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back();
        return $todo->name;
    }

    public function toggle(Todo $todo)
    {
        if ($todo->completed_at === null) {
            $todo->completed_at = now();
        } else {
            $todo->completed_at = null;
        }

        $todo->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->name = $request->input('name');

        $todo->save();

        return redirect()->route('todos.index');
    }
}
