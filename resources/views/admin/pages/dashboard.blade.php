@extends('admin.layout.base')

@section('title')
    | Dashboard
@endsection

@section('content-header')
    <h3>Dashboard</h3>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <a href="/admin/users">
                    <div class="card shadow bg-warning">
                        <div class="card-body">
                            <h1><i class="far fa-users float-end mt-3"></i></h1>
                            <h5><strong>Total Users</strong></h5>
                            <h5><strong>{{ App\Models\User::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/categories">
                    <div class="card shadow bg-primary">
                        <div class="card-body">
                            <h1><i class="far fa-grid-2 float-end mt-3"></i></h1>
                            <h5><strong>Total Categories</strong></h5>
                            <h5><strong>{{ App\Models\Category::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/posts">
                    <div class="card shadow bg-info">
                        <div class="card-body">
                            <h1><i class="far fa-blog float-end mt-3"></i></h1>
                            <h5><strong>Total Posts</strong></h5>
                            <h5><strong>{{ App\Models\Post::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/bookings">
                    <div class="card shadow bg-dark">
                        <div class="card-body">
                            <h1><i class="far fa-calendar-check float-end mt-3"></i></h1>
                            <h5><strong>Total Bookings</strong></h5>
                            <h5><strong>{{ App\Models\Booking::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/feedbacks">
                    <div class="card shadow bg-secondary">
                        <div class="card-body">
                            <h1><i class="far fa-comments float-end mt-3"></i></h1>
                            <h5><strong>Total Feedbacks</strong></h5>
                            <h5><strong>{{ App\Models\Feedback::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/logs">
                    <div class="card shadow bg-success">
                        <div class="card-body">
                            <h1><i class="far fa-notebook float-end mt-3"></i></h1>
                            <h5><strong>Total Logs</strong></h5>
                            <h5><strong>{{ App\Models\Log::count() }}</strong></h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
