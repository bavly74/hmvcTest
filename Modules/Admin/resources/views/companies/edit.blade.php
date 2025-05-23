<!-- resources/views/company/edit.blade.php -->

@extends('admin::components.layouts.master')

@section('content')
<div class="container">
    <h2>Edit Company</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $company->name) }}"
                required
            >

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('company.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
