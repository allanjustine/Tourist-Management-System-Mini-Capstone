@extends('admin.layout.base')

@section('title')
    | Admin Posts
@endsection

@section('content-header')
    <h3>
        Posts
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
        <a href="/admin/posts/create" class="btn btn-primary mb-3 me-2 float-end">
            <i class="fa-solid fa-plus"></i> Add Post
        </a>
        <form action="{{ route('admin.posts.search') }}" method="GET">
            @csrf
            <input type="search" name="search" class="form-control mb-3 mx-2 float-start" style="width: 198px;"
                placeholder="Search">
            <button class="btn btn-primary"><i class="far fa-magnifying-glass"></i></button>
        </form>
    </div>
    <h4 class="text-center">Locations</h4>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID.</th>
                    <th>Post Image</th>
                    <th>Location Category</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @if (is_array($post->post_image))
                                @foreach ($post->post_image as $index => $imagePath)
                                    <img style="width: 40px; height: 40px; margin-bottom: -15px;" class="rounded-circle border"
                                        src="{{ Storage::url($imagePath) }}" alt="">
                                @endforeach
                            @else
                                <img style="width: 40px; height: 40px; margin-top: -10px;" class="rounded-circle border"
                                    src="{{ Storage::url($post->post_image) }}" alt="">
                            @endif

                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->location }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->contact }}</td>
                        <td>
                            @if ($post->room_quantity >= 0)
                                <span class="badge rounded-pill text-bg-primary">Available</span>
                            @else
                                <span class="badge rounded-pill text-bg-warning">Not Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/posts/update/{{ $post->id }}" class="btn btn-primary mb-1"><i
                                    class="far fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#deletePost{{ $post->id }}"><i class="far fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @include('admin.posts.delete')
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
        <h4 class="text-center mt-5">Hotels</h4>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Hotel Name</th>
                        <th>Room Number</th>
                        <th>Person Quantity</th>
                        <th>Room Available</th>
                        <th>Room Rate</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->hotel_name }}</td>
                            <td>{{ $post->room_number }}</td>
                            <td>{{ $post->person_quantity }}</td>
                            <td>{{ $post->room_quantity }}</td>
                            <td>&#8369;{{ number_format($post->price, 2) }}</td>
                            <td>{{ $post->date_start }}</td>
                            <td>{{ $post->date_end }}</td>
                            <td>
                                @if ($post->room_quantity >= 1)
                                    <span class="badge rounded-pill text-bg-primary">Available</span>
                                @else
                                    <span class="badge rounded-pill text-bg-warning">Not Available</span>
                                @endif
                            </td>
                            <td>
                                <a href="/admin/posts/update/{{ $post->id }}" class="btn btn-primary mb-1"><i
                                        class="far fa-pen-to-square"></i> Edit</a>
                                <a href="#" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                    data-bs-target="#deletePost{{ $post->id }}"><i class="far fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        @include('admin.posts.delete')
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
