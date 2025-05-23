<!-- resources/views/company/index.blade.php -->

@extends('admin::components.layouts.master')

@section('content')
<div class="container">
    <h2>Companies</h2>

    <a href="{{ route('companies.create') }}" class="mb-3 btn btn-success">Create New Company</a>

    @if ($companies->isEmpty())
        <div class="alert alert-info">No companies found.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $company->name }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
