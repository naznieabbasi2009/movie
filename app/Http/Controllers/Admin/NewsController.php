<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CategoryMovie;
use App\Models\CategoryNews;
use App\Models\Movie;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news=News::all();
        return view("Admin.News.index" , compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Admins = Admin::all();
        $categories = CategoryNews::all();
        return view("Admin.news.create" , compact(['categories','Admins']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3','string'],
            'description' => ['min:5','string','required'],
            'content' => ['required' , 'min:2','string'],
            'image' => ['mimes:jpg,jpeg,png','nullable'],
            'admin_id' => ['required'],
            'category_id' => ['required'],
        ]);
        $path=$request->file('image')->store('image' , 'public');
        News::create([
            'title' => $validated['title'] ,
            'description' => $validated['description'] ,
            'content' => $validated['content'] ,
            'image' => $path,
            'admin_id' => $validated['admin_id'] ,
            'category_id' => $validated['category_id'] ,
        ]);
        return redirect('Admin/news/index')->with('status', 'با موفقیت ثبت شد.');
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
