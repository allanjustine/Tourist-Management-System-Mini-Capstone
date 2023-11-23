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
                                <a href="#" class="btn btn-primary mb-1" data-bs-toggle="modal"
                                    data-bs-target="#checkout{{ $booking->id }}"><i class="far fa-check"></i> Checkout</a>
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
        </div>
        <button class="btn btn-dark" onclick="goBack()">Back <i class="far fa-arrow-left"></i></button>
    @else
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
                    <tr>
                        <td colspan="11" class="text-center">
                            No data found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-dark" onclick="goBack()">Back <i class="far fa-arrow-left"></i></button>
    @endif
@endsection
