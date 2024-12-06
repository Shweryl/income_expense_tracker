@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-center text-white">
                    <h5>Edit Transaction</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('transaction.update', $transaction->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $transaction->name)}}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-primary">Amount</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount', $transaction->amount)}}">
                                <span class="input-group-text bg-primary text-white">MMK</span>
                            </div>
                            @error('amount')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="from-group mb-3">
                            <label class="text-primary">Categories</label>
                            <select id="categorySelect" class="form-select" name="category_id" onchange="handleSelect()">
                                @foreach ($categories as $category )
                                    <option value="{{$category->id}}" @if(old('category_id', $transaction->category_id) == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                                <option value="redirect">Add Category</option>
                            </select>
                            @error('category_id')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" value="income" type="radio" name="type" id="flexRadioDefault1" @if(old('type', $transaction->type) == 'income') checked @endif>
                                <label class="form-check-label text-primary" for="flexRadioDefault1">
                                  Income
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="expense" type="radio" name="type" id="flexRadioDefault2" @if(old('type', $transaction->type) == 'expense') checked @endif>
                                <label class="form-check-label text-primary" for="flexRadioDefault2">
                                  Expense
                                </label>
                            </div>
                        </div>
                        @error('type')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="form-group my-3">
                            <label class="text-primary">Description</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" cols="3" name="description">{{old('description', $transaction->description)}}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('transaction.index')}}" class="btn btn-primary me-2">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function handleSelect(){
            let selectValue = document.getElementById('categorySelect').value;

            if(selectValue == 'redirect'){
                window.location.href= "{{route('category.create')}}";
            }
        }
    </script>
@endpush
