@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-center text-white">
                    <h5>New Budget</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('income.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-primary">Total Amount</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount')}}">
                                <span class="input-group-text bg-primary text-white">MMK</span>
                            </div>
                            @error('amount')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Start date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date')}}">
                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-primary">End date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{old('end_date')}}">
                            @error('end_date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Manage Income</label>
                            @foreach ($categories as $category)
                            <div class="mb-2">
                                <span class="">{{$category->name}}</span>
                                <input type="number" class="form-control" value="{{old('categories.'.$category->id)}}" name="categories[{{$category->id}}]" placeholder="0.0">
                            </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('income.index')}}" class="btn btn-primary me-2">Back</a>
                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
