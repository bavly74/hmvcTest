<?php

namespace Modules\Admin\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User ;
use App\Models\Course ;
class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function delete(User $user , Course $course) {
        return $user->hasRole('admin') ;
    }

}
