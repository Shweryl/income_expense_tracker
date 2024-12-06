@extends('layouts.app')
@section('content')
<div class="">
    <h3 class="text-center">Budget Summery</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="mb-2">Total Income</div>
                    <div>{{$income->amount}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="mb-2">Spend Amount</div>
                    <div>{{$spendAmount}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="mb-2">Remaining Amount</div>
                    <div>{{number_format($income->amount - $spendAmount, 2)}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="mb-2">From : {{date('d-m-Y', strtotime($income->start_date))}}</div>
                    <div>To : {{date('d-m-Y', strtotime($income->end_date))}}</div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Categories</th>
                    <th>Allocated Amount</th>
                    <th>Spend</th>
                    <th>Remaining Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budget_categories as $budgetCat)
                <tr>
                    <td>{{$budgetCat['category']}}</td>
                    <td>{{$budgetCat['allocated_amount']}}</td>
                    <td>{{$budgetCat['spend_amount'] == 0 ? '0.00' : $budgetCat['spend_amount'] }}</td>
                    <td>{{number_format($budgetCat['allocated_amount'] - $budgetCat['spend_amount'], 2)}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
