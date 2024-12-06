@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-primary text-center text-white">
                    <h5>New Expense</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('expense.update', $expense->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Note</label>
                            <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{old('note', $expense->note)}}">
                            @error('note')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="from-group mb-3">
                            <label class="text-primary">Categories</label>
                            <select id="categorySelect" class="form-select" name="category_id">
                                @foreach ($categories as $category )
                                    <option value="{{$category->id}}" {{$category->id == $expense->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-primary">Amount</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount', $expense->amount)}}">
                                <span class="input-group-text bg-primary text-white">MMK</span>
                            </div>
                            @error('amount')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="text-primary">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{old('date', date('Y-m-d', strtotime($expense->date)))}}">
                            @error('date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('expense.index')}}" class="btn btn-primary me-2">Back</a>
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
