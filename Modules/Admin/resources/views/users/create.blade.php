@extends('admin::components.layouts.master')

@section('title', 'Create User')

@section('content')
<div class="container mt-4">
    <h2>Create New User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select
                name="role"
                id="role"
                class="form-select @error('role') is-invalid @enderror"
                required
            >
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" >{{$role->name}}</option>
                @endforeach

            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
