<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Course;
class CourseController extends Controller
{

    public function index()
    {

        return view('admin::courses.index',[
            'courses'=>Course::all()
        ]);
    }



    public function create()
    {
        if( !Gate::allows('is_admin') ){
        abort(403);
        }
        return view('admin::courses.create');
    }



    public function store(Request $request) {
        if(!Gate::allows('is_admin')) {
            abort(403);
        }
        Course::create([
            'name'=>$request->name ,
            'start_date'=>$request->start_date ,
            'end_date'=>$request->end_date ,
            'instructor'=>$request->instructor ,
            'company'=>$request->company ,
            'type'=>$request->type ,
            'level'=>$request->level ,
            'students_number'=>$request->students_number ,
        ]);
        return redirect()->back()->with('success','course created successfully') ;
    }



    public function show($id)
    {
        return view('admin::show');
    }



    public function edit($id)
    {
        $course= Course::findOrFail($id);
        if(!Gate::allows('is_admin')) {
            abort(403);
        }
        return view('admin::courses.edit',['course'=>$course]);
    }



    public function update(Request $request, $id) {
        $course = Course::findOrFail($id);
        if(!Gate::allows('is_admin')) {
            abort(403);
        }
        $course->update([
            'name'=>$request->name ,
            'start_date'=>$request->start_date ,
            'end_date'=>$request->end_date ,
            'instructor'=>$request->instructor ,
            'company'=>$request->company ,
            'type'=>$request->type ,
            'level'=>$request->level ,
            'students_number'=>$request->students_number ,
        ]);

        return redirect()->back()->with('success','course updated successfully') ;
    }



    public function destroy($id) {
        $course = Course::findOrFail($id) ;
        Gate::authorize('delete',$course) ;
        $course->delete() ;
        return redirect()->back()->with('success','course deleted successfully') ;

    }
}
