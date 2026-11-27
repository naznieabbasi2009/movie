<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryMovie;
use App\Models\Collection;
use App\Models\Gallery;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries=Gallery::all();
        return view("Admin.gallery.index" , compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view("Admin.gallery.create" , compact(['movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'movie_id' => ['required'],
            'image'=>['required' , 'image' , 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image_gallery', 'public');
        }
        Collection::create([
            'title' => $validated['title'] ,
            'movie_id' => $validated['movie_id'] ,
            'image' => $path,
        ]);

        return redirect('Admin/gallery/')->with('status', 'با موفقیت ثبت شد.');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
