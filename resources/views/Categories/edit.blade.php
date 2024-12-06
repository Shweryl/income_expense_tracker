@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-center text-white">
                    <h5>Edit Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('category.update', $category->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <label for="" class="text-primary">Name</label>
                            <input type="text" class="form-control" name="name" value="{{old('name', $category->name)}}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('category.index')}}" class="btn btn-primary me-2">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
