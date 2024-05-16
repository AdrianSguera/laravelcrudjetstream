<?php

namespace App\Http\Controllers;

use App\Models\Assigment;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssigmentController extends Controller
{

    public function index()
    {
        $assigment = Assigment::all();
        return view('assigments.index')->with('assigments', $assigment);
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('assigments.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

         $assigment = Assigment::create($request->only('name'));
         $assigment->subjects()->attach($request->subjects);
 
         return redirect()->route('assigments.index');
     }

     public function show(String $id)
    {
        $assigment = Assigment::with('subjects')->findOrFail($id);
        return view('assigments.show', compact('assigment'));
    }

     public function edit(String $id)
     {
        $assigment = Assigment::with('subjects')->findOrFail($id);
        $subjects = Subject::all();
        return view('assigments.edit', compact('assigment', 'subjects'));
     }

     public function update(Request $request, String $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        // Buscar el estudiante por su ID
        $assigment = Assigment::findOrFail($id);

        // Actualizar los datos del estudiante
        $assigment->update($request->only('name'));
        $assigment->subjects()->sync($request->subjects);

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('assigments.index');
    }

    public function destroy(string $id)
    {
        $assigment = Assigment::findOrFail($id);

        $assigment->delete();

        return redirect()->route('assigments.index');
    }
}
