@extends('admin.layout.base')

@section('title')
    | Bookings
@endsection

@section('content-header')
    <h3>
        Bookings
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
        <a href="/admin/bookings/discount" class="btn btn-primary mb-3 me-2 float-end">
            <i class="fa-solid fa-tags"></i> Discount picker
        </a>
        <form action="{{ route('admin.bookings.search') }}" method="GET">
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
                    <th>Name</th>
                    <th>Address</th>
                    <th>Mobile Number</th>
                    <th>Hotel Booked</th>
                    <th>Hotel Location</th>
                    <th>Price</th>
                    <th>Room Number</th>
                    <th>Hotel Contact</th>
                    <th>Person Quantity</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->user->address }}</td>
                        <td>{{ $booking->user->phone }}</td>
                        <td>{{ $booking->post->hotel_name }}</td>
                        <td>{{ $booking->post->category->name }} / {{ $booking->post->location }}</td>
                        <td>&#8369;{{ number_format($booking->post->price, 2) }}</td>
                        <td>{{ $booking->post->room_number }}</td>
                        <td>{{ $booking->post->contact }}</td>
                        <td>{{ $booking->post->person_quantity }}</td>
                        <td>
                            <form action="{{ route('admin.confirm.booking', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($booking->status == false)
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                @else
                                    <a href="#" class="btn btn-primary mb-1" data-bs-toggle="modal"
                                        data-bs-target="#checkout{{ $booking->id }}"><i class="far fa-check"></i>
                                        Checkout</a>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @include('admin.bookings.delete')
                @empty
                    <tr>
                        <td colspan="11" class="text-center">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
