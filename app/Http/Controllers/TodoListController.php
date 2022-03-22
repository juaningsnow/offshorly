<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Request;
use Inertia\Inertia;

class TodoListController extends Controller
{
    public function index()
    {
        return Inertia::render('TodoList/Index', [
            'todoLists' => TodoList::where('user_id', auth()->user()->id)
                ->paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('TodoList/Create');
    }

    public function edit($id)
    {
        return Inertia::render('TodoList/Edit', [
            'todoList' => TodoList::find($id),
        ]);
    }

    public function store()
    {
        $attributes = Request::validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'date',
        ]);

        $attributes = array_merge($attributes, [
            'user_id' => auth()->user()->id
        ]);

        TodoList::create($attributes);

        return redirect('/todo-lists');
    }

    public function update($id)
    {
        $attributes = Request::validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'date'
        ]);

        $todoList = TodoList::find($id);
        $todoList->title = $attributes['title'];
        $todoList->description = $attributes['description'];
        $todoList->date = $attributes['date'];
        $todoList->save();

        return redirect('/todo-lists');
    }

    public function destroy($id)
    {
        $todoList = TodoList::find($id);
        $todoList->delete();
        return redirect('/todo-lists');
    }
}
