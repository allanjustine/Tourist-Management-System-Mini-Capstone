@extends('normal-view.layout.base')

@section('title')
    | Contact Us
@endsection

@section('content')
    <section class="mb-4 container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show text-center mt-5" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to
                    contact us
                    directly. Our team will come back to you within
                    a matter of hours to help you.</p>

                <div class="card p-5 d-flex justify-content-center shadow-sm">
                    <form action="{{ route('feedback') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid animated fadeIn @enderror"
                                        value="@auth {{ auth()->user()->name }} @else
                                            {{ old('name') }} @endauth"
                                        @auth readonly @endauth autocomplete="name" autofocus>
                                    <label for="name" class="">Your name</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid animated fadeIn @enderror"
                                        value=" @auth {{ auth()->user()->email }} @else
                                     {{ old('name') }} @endauth"
                                        autocomplete="email" @auth readonly @endauth autofocus>
                                    <label for="email" class="">Your email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="5"
                                        class="form-control @error('message') is-invalid animated fadeIn @enderror" autocomplete="message" autofocus>{{ old('message') }}</textarea>
                                    <label for="message">Your message</label>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary form-control"><i class="far fa-paper-plane"></i>
                            Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
