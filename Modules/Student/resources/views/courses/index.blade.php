@extends('student::components.layouts.master') {{-- or your layout file --}}

@section('title', 'My Courses')
@section('content')
<div class="w-full px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">My Courses</h1>

    @if($courses->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Notice</p>
            <p>You are not enrolled in any courses.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="table table-bordered table-striped w-100">
                <thead>
                    <tr class="bg-gray-100 text-sm font-medium text-gray-700 uppercase tracking-wider">
                        <th class="px-6 py-3 border-b text-left">#</th>
                        <th class="px-6 py-3 border-b text-left">Course Name</th>
                        <th class="px-6 py-3 border-b text-left">Instructor</th>
                        <th class="px-6 py-3 border-b text-left">Company</th>
                        <th class="px-6 py-3 border-b text-left">Start Date</th>
                        <th class="px-6 py-3 border-b text-left">End Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($courses as $index => $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->instructor }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->company->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->start_date ?? '—' }}</td>
                            <td class="px-6 py-4 border-b">{{ $course->end_date ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
