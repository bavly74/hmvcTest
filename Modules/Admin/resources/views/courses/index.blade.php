@extends('admin::components.layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Courses</h2>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @can('is_admin')<a href="{{route('courses.create')}}" class="btn btn-primary" >Add</a>@endcan
    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Instructor</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Students No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>{{ $course->instructor }}</td>
                        <td>{{ $course->company }}</td>
                        <td>{{ $course->type }}</td>
                        <td>{{ $course->level }}</td>
                        <td>{{ $course->students_number }}</td>
                        <td>
                            <!-- gate  -->
                        @can('is_Admin')<a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a> @endcan

                        <!-- gate with policy  -->
                        @can('delete',$course)    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Optional: pagination --}}
    {{-- {{ $courses->links() }} --}}
</div>
@endsection
