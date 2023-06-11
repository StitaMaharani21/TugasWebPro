@extends('project.master')
@section('project')
    <!-- Main content -->
    <section id="content" class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Data Project
                    </div>
                    <div class="card-body">
                        <table style="width: 100%; margin-top: 10px" class="datatables">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Portofolio Title</th>
                                <th>Portofolio Description</th>
                                <th>Image Portofolio</th>
                            </tr>
                            @foreach ($portofolio as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->category->type }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><img src="{{ asset($item->image_url) }}" style="width: 200px; height: 100px"></td>
                                    <td>

                                        <a href="{{ route('portofolio.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        <button class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault(); document.getElementById('delete-portofolio-{{ $item->id }}').submit()">Delete</button>

                                        <form id="delete-portofolio-{{ $item->id }}"
                                            action="{{ route('portofolio.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
