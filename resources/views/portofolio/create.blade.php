@extends('project.master')
@section('project')
    <!-- Main content -->
    <section id="content" class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Create New Portofolio</div>
                            <div class="card-body">
                                <form action="{{ url('portofolio/create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Portofolio Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Portofolio Description</label>
                                        <input type="text" class="form-control" name="description"
                                            value="{{ old('description') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Image Portofolio</label>
                                        <input type="file" class="form-control-file" name="image_url" accept="image/*">
                                    </div>


                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
