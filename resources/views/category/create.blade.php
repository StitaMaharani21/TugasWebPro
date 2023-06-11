@extends('project.master')
@section('project')
    <!-- Main content -->
    <section id="content" class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Create New Category</div>
                            <div class="card-body">
                                <form action="{{ url('category/create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Category Type</label>
                                            <input type="text" class="form-control" 
                                                placeholder="Enter category type" name="type">
                                        </div>
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
