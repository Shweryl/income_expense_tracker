@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-center text-white">
                    <h5>New Category</h5>
                </div>
                <div class="card-body ">
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="" class="text-primary">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('category.index')}}" class="btn btn-primary me-2">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
