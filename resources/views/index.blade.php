@extends('layouts.master')
@section('content')
    {{-- Display success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="container my-4">
    <div class="row" style="justify-content:space-evenly">
        @foreach ($courses as $course)
            <div class="mb-3 shadow-sm col-4 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="mb-1 card-text"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('F j, Y') }}</p>
                    <p class="card-text"><strong>Company:</strong> {{ $course->company->name }}</p>
{{--                    <form action="{{ route('course.apply',[$course->id]) }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-primary">Apply</button>--}}
{{--                    </form>--}}
                    <a href="{{route('course.apply',['id'=>$course->id])}}">Apply</a>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection

