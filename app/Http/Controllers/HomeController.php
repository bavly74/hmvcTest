<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course ;
use App\Http\Controllers\FatoorahController ;
use App\Fatoorah\FatoorahService ;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    private $fatoorah_service ;
    public function __construct(FatoorahService $fatoorah_service){
        $this->fatoorah_service = $fatoorah_service ;
    }

    public function index(){
        $courses = Course::with('company')->get() ;
        return view('index',compact('courses'));
    }
    public function apply($id)
    {
       return view('course.paybtns',compact('id'));

    }
    public function applyForCourse(Request $request , $id) {
        $user = auth()->user() ;
        $course = Course::findOrFail($id) ;
        $user->courses()->attach($course->id) ;
        $data = [
         'CustomerName'=>$user->name ,
            'InvoiceValue'=>100 ,
            'NotificationOption'=>'ALL' ,
            'CustomerMobile'=>'1212486377' ,
            'CustomerEmail'=>$user->email,
            'CallBackUrl'=>'http://127.0.0.1:8000/api/callback' ,
            'ErrorUrl' =>'http://127.0.0.1:8000/api/error' ,
            'Language' =>'ar' ,
            'MobileCountryCode'=>'+20'
        ];
        return  $this->fatoorah_service->sendPayment($data) ;
    }

    public function storeFile(Request $request) {
        $request->validate([
            'file'=>'required|image|mimes:jpg,jpeg,png|max:3000'
        ]);
        $file = $request->file('file') ;
        $extension = $file->getClientOriginalExtension() ;
        $fileName = Str::random().'.'.$extension ;
        $path = $file->storeAs('/images',$fileName,'public') ;
         return redirect()->back()->with('success', 'file uploaded') ;

    }

}
