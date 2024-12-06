@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Transaction List</h2>
            <hr class="my-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <div class="dropdown me-3">
                        <div role="button" class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{-- @if(!request()->has('type'))
                            <span>Filter by Type</span>
                            @elseif (request()->has('type') && request('type') == 'income')
                            <span>Filter by Income</span>
                            @elseif (request()->has('type') && request('type') == 'expense')
                            <span>Filter by Expense</span>
                            @endif --}}

                            <span>Filter by Type</span>

                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{!request()->has('type') ? 'active' : ''}}" href="{{ route('transaction.index') }}">All</a></li>
                            <li id="incomeItem"><a class="dropdown-item {{request('type') == 'income' ? 'active' : ''}}"
                                    href="{{ route('transaction.index', ['type' => 'income']) }}">Income</a></li>
                            <li id="expenseItem"><a class="dropdown-item {{request('type') == 'expense' ? 'active' : ''}}"
                                    href="{{ route('transaction.index', ['type' => 'expense']) }}">Expense</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <div role="button" class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span>Filter by Category</span>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{!request()->has('category') ? 'active' : ''}}" href="{{ route('transaction.index') }}">All</a></li>
                            @foreach ($categories as $category)
                            <li id="incomeItem"><a class="dropdown-item {{request('category') == $category->id ? 'active' : ''}}"
                                href="{{ route('transaction.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="{{ route('transaction.index') }}">
                    @if (request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <button type="submit" class="input-group-text btn btn-primary">
                            <i class="bi bi-search text-white"></i>
                        </button>
                    </div>
                </form>
            </div>
            <hr class="my-2">
            @if(request('type'))
                <small class="text-muted">Filter by Type : {{request('type')}}</small>
            @endif
            @if(request('category'))
            @php $category = $categories->where('id', request('category'))->first(); @endphp

                <small class="text-muted">Filter by Category : {{ $category->name }}</small>
            @endif
            @if (request('search'))
                <div class="me-4 position-relative">
                    <span>Search By :: {{ request('search') }}</span>
                    <a href="{{ (request('type')) ? route('transaction.index',['type' => request('type')]) : route('transaction.index') }}" class="position-absolute right-0 top-0 translate-middle ">
                        <i class="bi bi-x-circle text-black-50 hover-link" style="font-size: 12px"></i>
                    </a>
                </div>
            @endif
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <p class="mb-0">{{ $transaction->name }}</p>
                                <span class="badge text-bg-primary">{{ $transaction->created_at->format('d-m-Y') }}</span>
                            </td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>
                                <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('transaction.destroy', $transaction->id) }}" class="d-inline"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash3"></i>
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
            <div class="pagination-custom">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection


