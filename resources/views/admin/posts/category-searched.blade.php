@extends('admin.layout.base')

@section('title')
    | @if ($search)
        Search result for "{{ $search }}"
    @else
        Ops! No records found!
    @endif
@endsection

@section('content-header')
    <h3>
        @if ($search)
            Search result for "{{ $search }}"
        @else
            Ops! No records found!
        @endif
    </h3>
@endsection

@section('content')
    @if ($search)
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
                                    data-bs-target="#deleteCategory{{ $category->id }}"><i class="far fa-trash"></i>
                                    Delete</a>
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
        </div>
        <button class="btn btn-dark" onclick="goBack()">Back <i class="far fa-arrow-left"></i></button>
    @else
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
                    <tr>
                        <td colspan="4" class="text-center">
                            No data found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-dark" onclick="goBack()">Back <i class="far fa-arrow-left"></i></button>
    @endif
@endsection
