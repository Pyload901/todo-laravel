<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Laravel\Pail\ValueObjects\Origin\Console;
class Todo extends Controller
{
    private TodoService $todoService;
    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = $this->todoService->getAll();
        return view("pages.todo", compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $this->todoService->create($data);
        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        if ($this->todoService->update($id, $data)) {
            return redirect()->route('todo.index')->with('success', 'Todo updated successfully.');
        } else {
            return redirect()->route('todo.index')->with('error', 'Todo not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if ($this->todoService->delete($id)) {
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');
        } else {
            return redirect()->route('todo.index')->with('error', 'Todo not found.');
        }
        
    }
}
