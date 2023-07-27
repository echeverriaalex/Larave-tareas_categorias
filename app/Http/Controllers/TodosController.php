<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    // index para mostrar todo

    // almacenar
    
    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function store(Request $request){

        // validamos los datos
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // creamos, asignamos y guardamos
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        // redirigimos
        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }   

    public function show($id){
        $todo = Todo::find($id);
        $categories = Category::all();
        return view('todos.show', ['todo' => $todo, 'categories' => $categories ]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title;

        //dd($todo); // sirve para ver toda la info como si fuera consola
        //dd($request);

        $todo->save();
        //return view('todos.index', ['success' => "Tarea actualizada" ]);
        return redirect()->route('todos')->with('success', "Tarea actualizada");
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', "Tarea eliminada");
    }
}
