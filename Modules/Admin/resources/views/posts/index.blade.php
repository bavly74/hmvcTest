@extends('admin::components.layouts.master')
@section('content')
<div class="container">
    <h2 class="mb-4">Posts</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('posts.create')}}" class="btn btn-sm btn-success">Add</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->body, 100) }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>
                    @can('edit',$post) <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a> @else <button disabled class="btn btn-sm btn-warning">Edit</button> @endcan
                      @can('destroy',$post)
                      <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @else
                            <button disabled class="btn btn-sm btn-danger">Delete</button>

                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
