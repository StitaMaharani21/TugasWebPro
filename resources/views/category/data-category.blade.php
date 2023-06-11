@extends('project.master')
@section('project')
    <!-- Main content -->
    <section id="content" class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Data Category
                    </div>
                    <div class="card-body">
                        <table style="width: 100%; margin-top: 10px" class="datatables">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                            </tr>
                            @foreach ($category as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>

                                        <a href="{{ route('category.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        <button class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault(); document.getElementById('delete-category-{{ $item->id }}').submit()">Delete</button>

                                        <form id="delete-category-{{ $item->id }}"
                                            action="{{ route('category.destroy', $item->id) }}" method="POST">
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
