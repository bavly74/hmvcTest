@extends('admin::components.layouts.master')

@section('content')
<div class="container mx-auto max-w-2xl p-4 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Post</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1" for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1" for="body">Body</label>
            <textarea name="body" id="body" rows="5" class="w-full border rounded px-3 py-2">{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection
