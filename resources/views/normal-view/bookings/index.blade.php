@extends('normal-view.layout.base')

@section('title')
    | My Bookings
@endsection

@section('content')
    <div class="container mt-3">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h3>My bookings</h3>
        @forelse ($bookings as $booking)
            <div class="card mb-2" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if (is_array($booking->post->post_image))
                                @foreach ($booking->post->post_image as $index => $imagePath)
                                    <img class="img-fluid h-100 w-100" src="{{ Storage::url($imagePath) }}" alt="">
                                @break
                            @endforeach
                        @else
                            <img class="img-fluid h-100 w-100" src="{{ Storage::url($post->post_image) }}"
                                alt="">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2>Booking details</h2>
                        <div class="container">
                            <ul>
                                <li><strong>Hotel name:</strong> {{ $booking->post->hotel_name }}</li>
                                <li><strong>Contact number:</strong> {{ $booking->post->contact }}</li>
                                <li><strong>Location:</strong> {{ $booking->post->category->name }},
                                    {{ $booking->post->location }}</li>
                                <li><strong>Room number:</strong> {{ $booking->post->room_number }}</li>
                                <li><strong>Good for:</strong> {{ $booking->post->person_quantity }} persons</li>
                                <li><strong>Date start:</strong>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->post->date_start)->format('F j, Y') }}
                                </li>
                                <li><strong>Date end:</strong>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->post->date_end)->format('F j, Y') }}
                                </li>
                                <li><strong>Price:</strong> &#8369;{{ number_format($booking->post->price, 2) }}/Room
                                </li>
                            </ul>
                            @if ($booking->status == true)
                            <div class="a btn btn-success"><i class="far fa-check"></i> Accepted</div>
                            @else
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#cancel{{ $booking->id }}"><i class="far fa-xmark-circle"></i> Cancel
                                booking</a>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @includeIf('normal-view.bookings.cancel')
    @empty
        <div class="card" style="border: none;">
            <div class="card-body">
                <h3 class="text-center">No bookings yet.</h3>
            </div>
        </div>
    @endforelse
</div>
@endsection
