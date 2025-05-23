<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Company\Models\Company;
class Course extends Model
{
    protected $guarded = [] ;
    public function students(){
        return $this->belongsToMany(User::class, 'course_student','student_id') ;
    }

    public function company(){
        return $this->belongsTo(Company::class) ;
    }
}
