@extends('admin::components.layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Create New Post</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Display success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        {{-- Body --}}
        <div class="mb-3">
            <label for="body" class="form-label">Post Body</label>
            <textarea name="body" class="form-control" rows="6" required>{{ old('body') }}</textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection
