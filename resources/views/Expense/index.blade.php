@extends('layouts.app')

@section('content')
    <div class="card border border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2>Expense List</h2>
                <div class="">
                    <a href="{{route('expense.create')}}" class="btn btn-primary text-white">
                        <i class="bi bi-plus-circle fs-6 me-1"></i>
                        <span>Add New</span>
                    </a>
                </div>
            </div>
            <hr class="my-2">
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Note</th>
                        <th>Amount</th>
                        <th>Total Allocated Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{$expense->note}}
                            </td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->related_income_category->pivot->allocated_amount }}</td>
                            <td>{{ $expense->category->name }}</td>
                            <td>{{ date('d-m-Y', strtotime( $expense->date)) }}</td>
                            <td>
                                <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-sm btn-primary" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('expense.destroy', $expense->id) }}" class="d-inline"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="if(!confirm('Are you sure to delete')){event.preventDefault()}" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


