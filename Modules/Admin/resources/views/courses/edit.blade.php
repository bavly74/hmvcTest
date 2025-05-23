@extends('admin::components.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Course</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $course->start_date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $course->end_date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Instructor</label>
            <input type="text" name="instructor" class="form-control" value="{{ old('instructor', $course->instructor) }}" required>
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <select name="company" class="form-control" required>
                @foreach ($companies as $company )
                    <option value="{{ $company->id }}" {{ $course->company_id==$company->id ?'selected':'' }} >{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $course->type) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <input type="text" name="level" class="form-control" value="{{ old('level', $course->level) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of Students</label>
            <input type="number" name="students_number" class="form-control" value="{{ old('students_number', $course->students_number) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
