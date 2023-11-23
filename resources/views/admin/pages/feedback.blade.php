@extends('admin.layout.base')

@section('title')
    | Feedbacks
@endsection

@section('content-header')
    <h3>
        Feedbacks
    </h3>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $feedbacks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
