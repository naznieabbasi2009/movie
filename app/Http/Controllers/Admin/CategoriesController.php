<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::all();
        return view('Admin.categories.index', compact('Categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required' , 'min:3'],
            'description' => ['required' , 'nullable', 'min:3'],
            'status' => ['required', 'integer'],
        ]);
        Category::create([
            'name' => $validated['name'] ,
            'description' => $validated['description'] ,
            'status' => $validated['status'] ,
        ]);
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
        $Categories = Category::all();
        return view('Admin.categories.index', compact('Categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Categories = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'status' => ['required', 'integer']
        ]);
        $Categories->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
