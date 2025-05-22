@extends('admin::components.layouts.master') {{-- Or use 'layouts.admin' if this is for admin panel --}}

@section('content')
<div class="container">
    <h2>Create Course</h2>

    {{-- Display success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

    {{-- Course creation form --}}
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="instructor" class="form-label">Instructor</label>
            <input type="text" name="instructor" class="form-control" value="{{ old('instructor') }}" required>
        </div>

        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="text" name="level" class="form-control" value="{{ old('level') }}" required>
        </div>

        <div class="mb-3">
            <label for="students_number" class="form-label">Number of Students</label>
            <input type="number" name="students_number" class="form-control" value="{{ old('students_number') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
</div>
@endsection
