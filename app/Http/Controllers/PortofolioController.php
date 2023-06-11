<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;




class PortofolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolio = Portofolio::all();
        return view('portofolio.data-portofolio', compact('portofolio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all(); 
        return view('portofolio.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'=>'required',
            'title' => 'required',
            'description' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            toastr()->error($validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            if ($request->hasFile('image_url')) {
                $imagePath = $request->file('image_url')->store('uploads', 'public');
            } else {
                $imagePath = '';
            }
            $portofolio = Portofolio::where('title', $request->title)->first();
            if ($portofolio == null) {
                $portofolio = new Portofolio;
                $portofolio->category_id = $request->category;
                $portofolio->title = $request->title;
                $portofolio->description = $request->description;
                $portofolio->image_url = '/storage/' . $imagePath;
                $portofolio->save();
                toastr()->success('Data Saved Successfully', 'Successful');
                return redirect('portofolio');
            } else {
                toastr()->warning('Title ' . $request->title . ' Already Existing', 'Warning', ['timeOut' => 5000]);
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
        $portofolio = Portofolio::findOrFail($id);
        $category = Category::all();

        return view('portofolio.edit', compact('portofolio','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category'=>'required',
            'title' => 'required',
            'description' => 'required',
            //'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            toastr()->error($validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            if ($request->hasFile('image_url')) {
                $validator = Validator::make($request->all(), [
                    'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                if ($validator->fails()) {
                    toastr()->error($validator->messages()->first());
                    return redirect()->back()->withInput();
                } else {
                    if ($request->hasFile('image_url')) {
                        $imagePath = $request->file('image_url')->store('uploads', 'public');
                    } else {
                        $imagePath = '';
                    }

                    $portofolio = Portofolio::findOrFail($id);
                    Storage::delete('uploads/' . $portofolio->image_url);
                    $portofolio->category_id = $request->category;
                    $portofolio->title = $request->title;
                    $portofolio->description = $request->description;
                    $portofolio->image_url = '/storage/' . $imagePath;
                    $portofolio->save();
                }
            } else {
                $portofolio = Portofolio::findOrFail($id);
                $portofolio->category_id = $request->category;
                $portofolio->title = $request->title;
                $portofolio->description = $request->description;
                $portofolio->save();
            }

            toastr()->success('Data Saved Successfully', 'Successful');
            return redirect('portofolio');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $portofolio->delete();

        return redirect('portofolio');
    }
}
