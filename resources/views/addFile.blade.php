@extends('layouts.master')
@section('content')
@if(session('success'))
 <div class="text-success"> {{session('success')}}</div>
@endif
<form action="{{route('storeFile')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    @error('file') <div class="text-danger"> {{$message}}</div> @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
