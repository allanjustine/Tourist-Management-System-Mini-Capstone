@extends('admin.layout.base')

@section('title')
    | Location Categories
@endsection

@section('content-header')
    <h3>
        Location Categories
    </h3>
@endsection

@section('content')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm-12">
        <a href="/admin/categories/create" class="btn btn-primary mb-3 me-2 float-end">
            <i class="fa-solid fa-grid-2-plus"></i> Add Category
        </a>
        <form action="{{ route('admin.category.search') }}" method="GET">
            @csrf
            <input type="search" name="search" class="form-control mb-3 mx-2 float-start" style="width: 198px;"
                placeholder="Search">
            <button class="btn btn-primary"><i class="far fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID.</th>
                    <th>Location Category Name</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->remarks }}</td>
                        <td>
                            <a href="/admin/categories/update/{{ $category->id }}" class="btn btn-primary mb-1"><i
                                    class="far fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#deleteCategory{{ $category->id }}"><i class="far fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @include('admin.posts.delete-category')
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
