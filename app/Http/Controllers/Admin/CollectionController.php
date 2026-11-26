<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CategoryMovie;
use App\Models\CategoryNews;
use App\Models\Collection;
use App\Models\Movie;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Collection::with('movie');
        return view("Admin.collection.index" , compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view("Admin.collection.create" , compact(['movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'movie_id' => ['required'],
            'poster' => ['mimes:jpg,jpeg,png','nullable'],
        ]);

        $path=$request->file('image')->store('image' , 'public');

        Collection::create([
            'title' => $validated['title'] ,
            'movie_id' => $validated['movie_id'] ,
            'image' => $path,
        ]);

        return redirect('Admin/collection/')->with('status', 'با موفقیت ثبت شد.');

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
        $movies = CategoryMovie::all();
        $collection = Collection::findOrFail($id);
        return view("Admin.collection.edit" , compact(['collection' , 'movies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'movie_id' => ['required'],
            'image' => ['mimes:jpg,jpeg,png','nullable'],
        ]);

        if($request->file('image') !== null){
            $validated["image"]=$request->file('image')->store('image' , 'public');
        }else{
            $validated["image"]="";
        }
        $collection->update($validated);
        return redirect('Admin/collection/')->with('status', 'با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Collection= collection::findOrFail($id);
        if ($Collection->image && Storage::disk('public')->exists($Collection->image)) {
            Storage::disk('public')->delete($Collection->image);
        }

        $Collection->delete();
        return redirect('Admin/collection/')->with('status', 'با موفقیت ویرایش شد.');
    }
}
