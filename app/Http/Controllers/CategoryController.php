<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('layouts.category.index', compact('categories'));
    }


    public function create()
    {
        return view('layouts.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        // dd($category->id);
        return redirect()->route('category.index', $category->id);
    }
    public function show($id)
    {
        $category = Category::find($id);
        // dd($category);

        return view('layouts.category.show', ['category' => $category]);
    }


    public function edit($id)
    {
        $category = Category::find($id);

        return view('layouts.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'required|min:3',
        //     'slug ' => 'required',
        // ]); 
        // dd($request);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->update();
        $request->session()->flash('message', 'Successfully modified the category !');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        $category->delete();
        $request->session()->flash('message', 'Successfully deleted the category!');
        return redirect()->bacK();
    }
}
