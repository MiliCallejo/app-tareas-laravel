<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Tasks::latest()->paginate(3);
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Tasks::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea creada con exito!');
        //dd($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks): View
    {
        return view('edit', ['tasks' => $tasks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks): RedirectResponse
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $tasks->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con exito!');
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con exito!');
    }
}
