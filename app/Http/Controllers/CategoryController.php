<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();

        return view('category.data-category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error($validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            $category = Category::where('type', $request->type)->first();
            if ($category == null) {
                $category = new Category;
                $category->type = $request->type;
                $category->save();
                toastr()->success('Data Saved Successfully', 'Successful');
                return redirect('category');
            } else {
                toastr()->warning('type ' . $request->type . ' Already Existing', 'Warning', ['timeOut' => 5000]);
                return redirect()->back()->withInput();
            }
        }
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
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',

        ]);
        if ($validator->fails()) {
            toastr()->error($validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            $category = Category::findOrFail($id);
            $category->type = $request->type;
            $category->save();
        }
        toastr()->success('Data Saved Successfully', 'Successful');
        return redirect('category');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('category');
    }
}
