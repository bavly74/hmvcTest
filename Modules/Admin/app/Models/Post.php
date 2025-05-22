<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

// use Modules\Admin\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function author(){
        return $this->belongsTo(User::class,'created_by') ;
    }

    // protected static function newFactory(): PostFactory
    // {
    //     // return PostFactory::new();
    // }
}
