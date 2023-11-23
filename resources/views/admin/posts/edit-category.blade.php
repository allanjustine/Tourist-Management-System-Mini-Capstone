@extends('admin.layout.base')

@section('title')
    | Location Category Update
@endsection

@section('content-header')
    <h3>
        Location Category Update
    </h3>
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card col-md-6 bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
                <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <div class="form-outline">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $category->name }}" autocomplete="name" autofocus />
                            <label class="form-label" for="name">Location Name Category</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-outline">
                            <textarea type="text" id="remarks" name="remarks" rows="5"
                                class="form-control @error('remarks') is-invalid @enderror" autocomplete="remarks" autofocus>{{ $category->remarks }}</textarea>
                            <label for="remarks">Remarks</label>
                            @error('remarks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
