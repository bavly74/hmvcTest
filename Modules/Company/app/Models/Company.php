<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Course;
// use Modules\Company\Database\Factories\CompanyFactory;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    public function courses() {
        return $this->hasMany(Course::class,'company_id') ;
    }

}
