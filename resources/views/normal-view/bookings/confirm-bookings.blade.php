@extends('normal-view.layout.base')

@section('title')
    | Confirm Booking
@endsection

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('post_id')
            <div class="alert alert-danger alert-dismissible fade show text-center mt-5" role="alert">
                No available rooms. Please check another one.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
    </div>
    <div class="container d-flex justify-content-center my-5">
        <div class="card col-md-6">
            <div class="card-header">
                <h3 class="text-center card-title">You book "{{ $post->hotel_name }}"</h3>
                <p class="text-center card-title">Check the booking details below to proceed checkout</p>
            </div>
            <div class="card-body">
                <div id="carouselExample{{ $post->id }}" class="carousel slide">
                    <div class="carousel-inner">
                        @if (is_array($post->post_image))
                            @foreach ($post->post_image as $index => $imagePath)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ Storage::url($imagePath) }}" class="d-block w-100" style="height: 300px;"
                                        alt="...">
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
                        <h5 class="card-title"><strong>{{ $post->hotel_name }}</strong></h5>
                        <h6 class="card-title"><strong>Price: </strong>&#8369;{{ number_format($post->price, 2) }}</h6>
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
                        <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $post->date_start)->format('F j, Y') }} -
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $post->date_end)->format('F j, Y') }} </p>
                    </div>
                    <p class="card-text">{{ $post->description }}</p>
                </div>

                <form action="{{ route('create.booking', $post->id) }}" method="POST"
                    class="d-flex justify-content-center">
                    @csrf
                    @method('PUT')
                    <input type="number" name="post_id" value="{{ $post->id }}" hidden>
                    @if ($post->room_quantity == 0)
                        <a href="#" onclick="goBack()" class="btn btn-secondary"><i class="far fa-arrow-left"></i>
                            Back</a>
                    @else
                        <button class="btn btn-primary w-50" type="submit"><i class="far fa-calendar-check"></i>
                            Checkout</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <p class="text-center"><a href="#" class="btn btn-secondary my-2 w-25" onclick="goBack()"><i
        class="far fa-arrow-left"></i>
    Back</a></p>
@endsection
