@extends('layouts.app')
@section('content')
<div>
    <div class="row">
        <div class="d-flex justify-content-between">
            <h2 class="text-primary mb-3">Income Detail</h2>
            <div>
                <a href="{{route('income.index')}}" class="btn btn-sm btn-primary text-white">
                    <i class="bi bi-arrow-left-circle"></i>
                    Back
                </a>
                <form action="{{ route('income.destroy', $income->id) }}" class="d-inline"
                    method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure to delete')){event.preventDefault()}">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Income Info
                </div>
                <div class="card-body text-primary">
                    <div class="mb-1">
                        <span>Name - </span>
                        <span>{{$income->name}}</span>
                    </div>
                    <div class="mb-1">
                        <span>Amount - </span>
                        <span class="text-warning">{{$income->amount}}</span>
                    </div>
                    <div class="mb-1">
                        <span>Start Date - </span>
                        <span>{{date('d-m-Y', strtotime($income->start_date))}}</span>
                        <i class="bi bi-calendar2-event"></i>
                    </div>
                    <div class="">
                        <span>End Date - </span>
                        <span>{{date('d-m-Y', strtotime($income->end_date))}}</span>
                        <i class="bi bi-calendar2-event"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card px-3 shadow-sm">
               <div class="card-body">
                <table class="table table-striped">
                    <thead class="">
                        <tr class="">
                            <th class="text-primary">Categories</th>
                            <th class="text-primary">Allocated Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($income->categories as $category )
                        <tr>
                            <td class="text-primary">{{$category->name}}</td>
                            <td class="text-primary">{{$category->pivot->allocated_amount}} MMK</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
