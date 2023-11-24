@extends('normal-view.layout.base')

@section('title')
    | {{ $category->name }} list
@endsection

@section('content')
    <div class="container">
        <h3 class="my-4"><i class="far fa-hotel"></i> {{ $category->name }} hotels</h3>
        <div class="row">
            @if ($category)
                @forelse ($category->posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div id="carouselExample{{ $post->id }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @if (is_array($post->post_image))
                                        @foreach ($post->post_image as $index => $imagePath)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($imagePath) }}" class="d-block w-100"
                                                    style="height: 300px;" alt="...">
                                            </div>
                                        @endforeach
                                    @else
                                        <img src="{{ Storage::url($imagePath) }}" class="d-block w-100" alt="...">
                                    @endif
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExample{{ $post->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $post->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $post->hotel_name }}</h5>
                                    <h6 class="card-title">&#8369;{{ number_format($post->price, 2) }}</h6>
                                </div>
                                <p class="card-text">
                                    @if ($post->person_quantity <= 1)
                                        {{ $post->person_quantity }} person allowed
                                    @else
                                        {{ $post->person_quantity }} persons allowed
                                    @endif
                                </p>
                                <p class="card-text">
                                    <strong>Status: </strong>
                                    @if ($post->room_quantity == 0)
                                        <span class="text-danger">Not available</span>
                                    @else
                                        <span class="text-primary">Available</span>
                                    @endif
                                </p>

                                <h5><strong>Appointment date</strong></h5>
                                <div class="d-flex justify-content-between">
                                    <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $post->date_start)->format('F j, Y') }}
                                        -
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $post->date_end)->format('F j, Y') }}
                                    </p>
                                </div>
                                <p class="card-text">{{ $post->description }}</p>
                                <a href="/confirm-booking/{{ $post->id }}" class="btn btn-primary"><i
                                        class="far fa-book-circle-arrow-up"></i> Book Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No posts found</p>
                @endforelse
            @else
                <h1>No category found</h1>
                <p class="text-center"><a href="#" class="btn btn-secondary my-2 w-25" onclick="goBack()"><i
                            class="far fa-arrow-left"></i>
                        Back</a></p>
            @endif
        </div>
        <p class="text-center"><a href="#" class="btn btn-secondary my-2 w-25" onclick="goBack()"><i
                    class="far fa-arrow-left"></i>
                Back</a></p>
    </div>
@endsection
