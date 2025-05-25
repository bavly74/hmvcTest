<?php

namespace Modules\Student\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function index(User $user , Course $course) {
         return $course->student_id === $user->id;
    }
}
