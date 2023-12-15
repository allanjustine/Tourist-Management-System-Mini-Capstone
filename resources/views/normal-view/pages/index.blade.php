@extends('normal-view.layout.base')

@section('title')
    | Travel and Tours
@endsection

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/carousel1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption text-center">
                    <h5><strong>Enjoy the summer</strong></h5>
                    <p><strong>Summer sits upon the hill as a great floral wedding hat.</strong></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/carousel2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption text-center">
                    <h5><strong>Enjoy the mountain</strong></h5>
                    <p><strong>The mountain top was the crown of the world at her soles.</strong></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/carousel3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption text-center">
                    <h5><strong>Enjoy the river</strong></h5>
                    <p><strong>The river is mother to this land and the magic of our good dreams, our hopes.</strong></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="text-white py-2" style="background: linear-gradient(to right, #1569ca, #7beafe);">
        <h3 class="text-center">Categories</h3>
        <div class="category-list">
            <nav class="navbar navbar-expand">
                <div class="container-fluid">
                    <ul class="navbar-nav mx-auto mb-2">
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                    href="/category/{{ $category->id }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
        <div class="d-flex justify-content-center" data-aos="zoom-in-up">
            <div class="col-md-6">
                <form class="form-inline" action="{{ route('travels.and.tours.search') }}" method="GET">
                    @csrf
                    <div class="input-group">

                        <input type="search" class="form-control" placeholder="Search a place you want" aria-label="Search"
                            aria-describedby="button-addon2" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i
                                    class="far fa-magnifying-glass"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="my-4"><i class="far fa-location-dot"></i> Want to travel to</h1>

            <div class="row">
                @forelse ($categories as $category)
                    @if ($category->posts->isNotEmpty())
                        <div class="col-md-4 mb-4" data-aos="fade-up-left">
                            <div class="card">
                                <div class="card-content">
                                    <h6><strong>{{ $category->remarks }}</strong></h6>
                                </div>
                                @foreach ($category->posts as $post)
                                    @if (is_array($post->post_image))
                                        @foreach ($post->post_image as $index => $imagePath)
                                            <img class="border" src="{{ Storage::url($imagePath) }}" class="card-img"
                                                alt="" style="width: auto; height: 270px;">
                                        @break
                                    @endforeach
                                @else
                                    <img class="border" src="{{ Storage::url($imagePath) }}" class="card-img"
                                        alt="" style="width: auto; height: 270px;">
                                @endif
                            @break

                        @endforeach
                        <div class="card-img-overlay d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title text-white p-1 rounded"
                                    style="background: rgba(0, 0, 0, 0.5);">
                                    {{ $category->name }}</h5>
                                <p class="card-text text-white p-1 rounded" style="background: rgba(0, 0, 0, 0.5);">
                                    @if ($category->posts_count <= 1)
                                        <i class="far fa-location-dot   "></i> {{ $category->posts_count }} City
                                    @else
                                        <i class="far fa-location-dot   "></i> {{ $category->posts_count }} Cities
                                    @endif
                                </p>
                            </div>

                            <a href="/category/{{ $category->id }}" class="btn btn-primary align-self-end">See
                                More
                                <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h5 class="text-center">
                No records list
            </h5>
        @endforelse
    </div>
</div>
@endsection


<style>
.carousel img {
height: 600px;
}

.carousel-caption {
background: rgba(0, 0, 0, 0.5);
border-radius: 50% 50% 0 0;
}

.category-list {
overflow-y: scroll;
scrollbar-width: thin;
}

.card {
position: relative;
width: 300px;
height: 200px;
background-color: #f0f0f0;
border: 1px solid #ccc;
border-radius: 8px;
overflow: hidden;
margin: 20px;
transition: transform 0.3s;
}

.card-content {
position: absolute;
bottom: 0;
left: 0;
width: 100%;
height: 100%;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
background-color: rgba(80, 220, 241, 0.8);
color: #000000;
opacity: 0;
transform: translateY(100%);
transition: opacity 0.3s, transform 0.3s;
}

.card:hover .card-content {
opacity: 1;
transform: translateY(0);
}
</style>
