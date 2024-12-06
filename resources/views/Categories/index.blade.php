@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Category List</h2>
            <hr class="my-2">
            <div class="d-flex justify-content-between">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Category
                </a>
                <div class="d-flex">
                    @if (request('search'))
                        <div class="me-4 position-relative">
                            <span>Search By :: {{ request('search') }}</span>
                            <a href="{{ route('category.index') }}"
                                class="position-absolute right-0 top-0 translate-middle ">
                                <i class="bi bi-x-circle text-black-50 hover-link" style="font-size: 12px"></i>
                            </a>
                        </div>
                    @endif
                    <form action="{{ route('category.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <button type="submit" class="input-group-text btn btn-primary">
                                <i class="bi bi-search text-white"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-primary">{{ $category->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" class="d-inline"
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
