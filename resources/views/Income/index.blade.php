@extends('layouts.app')

@section('content')
    <div class="card border border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2>Income List</h2>
                <div class="">
                    <a href="{{route('income.create')}}" class="btn btn-primary text-white">
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
                        <th>Name</th>
                        <th>Total Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{$income->name}}
                            </td>
                            <td>{{ $income->amount }}</td>
                            <td>{{ date('d-m-Y', strtotime( $income->start_date)) }}</td>
                            <td>{{date('d-m-Y', strtotime( $income->end_date)) }}</td>
                            <td>
                                <a href="{{ route('income.edit', $income->id) }}" class="btn btn-sm btn-info" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('income.show', $income->id) }}" class="btn btn-sm btn-primary" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-title="View More">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </a>
                                <a href="{{ route('budget.show', $income->id) }}" class="btn btn-sm btn-info" data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-title="Budget">
                                    <i class="bi bi-wallet-fill"></i>
                                </a>
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


