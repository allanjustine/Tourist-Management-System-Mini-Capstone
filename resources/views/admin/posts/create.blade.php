@extends('admin.layout.base')

@section('title')
    | Post Create
@endsection

@section('content-header')
    <h3>
        Post Create
    </h3>
@endsection

@section('content')
    <div class="card bg-glass">
        <div class="card-body px-4 py-5 px-md-5">
            <form method="POST" action="{{ route('admin.posts.create') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <div class="form-outline">
                        <input id="post_image" type="file"
                            class="form-control pr-4 @error('post_image') is-invalid @enderror" name="post_image[]"
                            value="{{ old('post_image') }}" accept="image/*" autocomplete="post_image" multiple>
                        <label for="post_image">Upload post image</label>
                        @error('post_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                autocomplete="category_id" autofocus>
                                <option selected hidden value="">Select Category</option>
                                <option disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label class="form-label" for="category_id">Category</label>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>The category field is required.</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="location"
                                class="form-control @error('location') is-invalid @enderror" name="location"
                                value="{{ old('location') }}" autocomplete="location" autofocus />
                            <label class="form-label" for="location">Location</label>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="hotel_name"
                                class="form-control @error('hotel_name') is-invalid @enderror" name="hotel_name"
                                value="{{ old('hotel_name') }}" autocomplete="hotel_name" autofocus />
                            <label class="form-label" for="hotel_name">Hotel name</label>
                            @error('hotel_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="number" id="person_quantity" class="form-control @error('person_quantity') is-invalid @enderror"
                                name="person_quantity" value="{{ old('person_quantity') }}" autocomplete="person_quantity" autofocus />
                            <label class="form-label" for="person_quantity">Person quantity</label>
                            @error('person_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="number" id="room_number"
                                class="form-control @error('room_number') is-invalid @enderror" name="room_number"
                                value="{{ old('room_number') }}" autocomplete="room_number" autofocus />
                            <label class="form-label" for="room_number">Room number</label>
                            @error('room_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="number" id="room_quantity" class="form-control @error('room_quantity') is-invalid @enderror"
                                name="room_quantity" value="{{ old('room_quantity') }}" autocomplete="room_quantity" autofocus />
                            <label class="form-label" for="room_quantity">Room quantity</label>
                            @error('room_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="date" id="date_start"
                                class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                                value="{{ old('date_start') }}" autocomplete="date_start" autofocus />
                            <label class="form-label" for="date_start">Date start</label>
                            @error('date_start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="date" id="date_end"
                                class="form-control @error('date_end') is-invalid @enderror" name="date_end"
                                value="{{ old('date_end') }}" autocomplete="date_end" autofocus />
                            <label class="form-label" for="date_end">Date end</label>
                            @error('date_end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="number" id="contact"
                                class="form-control @error('contact') is-invalid @enderror" name="contact"
                                value="{{ old('contact') }}" autocomplete="contact" autofocus />
                            <label class="form-label" for="contact">Contact</label>
                            @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="number" id="price" class="form-control @error('price') is-invalid @enderror"
                                name="price" value="{{ old('price') }}" autocomplete="price" autofocus />
                            <label class="form-label" for="price">Price</label>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-outline">
                        <textarea type="text" id="description" name="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>{{ old('description') }}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Create post
                </button>
            </form>
        </div>
    </div>
@endsection
