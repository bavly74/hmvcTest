<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [] ;
    public function students(){
        return $this->belongsToMany(User::class) ;
    }
}
