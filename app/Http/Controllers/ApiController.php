<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Portofolio;
use App\Http\Requests\AddPortofolioRequest;
use App\Http\Requests\UpdatePortofolioRequest;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolio = Portofolio::all();
        return response($portofolio);
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
    public function store(AddPortofolioRequest $request)
    {
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('uploads', 'public');
        } else {
            $imagePath = '';
        }
        $portofolio = new Portofolio;
        $portofolio->category_id = $request->category;
        $portofolio->title = $request->title;
        $portofolio->description = $request->description;
        $portofolio->image_url = '/storage/' . $imagePath;
        $portofolio->save();

        return response('add portfolio success');
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
    public function update(UpdatePortofolioRequest $request, string $id)
    {
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('uploads', 'public');
        } else {
            $imagePath = '';
        }

        $portofolio = Portofolio::findOrFail($id);
        Storage::delete('uploads/' . $portofolio->image_url);
        // $portofolio->category_id = $request->category;
        if ($request->has('category')) {
            $portofolio->category_id = $request->category;
        }

        $portofolio->title = $request->title;
        $portofolio->description = $request->description;
        $portofolio->image_url = '/storage/' . $imagePath;
        $portofolio->save();

        return response('update portfolio success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $portofolio->delete();

        return response('delete portfolio success');
    }
}
