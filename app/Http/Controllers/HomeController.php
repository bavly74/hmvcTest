<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course ;
class HomeController extends Controller
{
    public function index(){
        $courses = Course::with('company')->get() ;
        return view('index',compact('courses'));
    }

    public function applyForCourse(Request $request , $id) {
        $user = auth()->user() ;
        $course = Course::findOrFail($id) ;
        $user->courses()->attach($course->id) ;

        return redirect()->back()->with('success','you have applied successfully') ;
    }

}
