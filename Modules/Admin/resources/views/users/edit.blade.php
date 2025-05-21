@extends('admin::components.layouts.master')

@section('title', 'Create User')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-4">
    <h2>Create New User</h2>

    <form action="{{ route('users.update',['id'=>$user->id]) }}" method="POST">
        @method('PUT')
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ $user->name }}"
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
                value="{{ $user->email }}"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        {{-- Role --}}
        <div class="mb-3">
            <label for="roles" class="form-label">Roles</label>
            @forelse($roles as $role)
            <label for="roles" class="form-label">{{$role->name}}</label>
            <input name="roles[]" type="checkbox" {{ $user->roles->contains($role->id) ? 'checked' : '' }} value="{{$role->id}}" >
            @empty
                <p>no roles found </p>
            @endforelse
            @error('roles')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Create User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
