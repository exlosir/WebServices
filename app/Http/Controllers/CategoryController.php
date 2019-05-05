<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', ['categories'=>Category::childrenAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::childrenAll();
        return view('admin.category.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name'=>'required'
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator->errors());
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent;
        $category->published = $request->published ? 1 : 0;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Запись успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $currCat = $category;
        $categories = Category::childrenAll();
        return view('admin.category.edit', ['currCat'=>$currCat, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required'
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator->errors());
        $category->name = $request->name;
        $category->parent_id = $request->parent;
        $category->published = $request->published ? 1 : 0;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Запись успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Запись успешно удалена');
    }
}
