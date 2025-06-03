@extends('layouts.master')
@section('content')

    <a href="{{route('course.applyForCourse',['id'=>$id])}}" class="btn btn-primary">My Fatoorah</a>

    <a href="{{route('paypal.pay')}}"  class="btn btn-primary">Pay Pal</a>

@endsection
