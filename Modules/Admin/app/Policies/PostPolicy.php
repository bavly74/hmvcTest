<?php

namespace Modules\Admin\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User ;
use Modules\Admin\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function edit(User $user , Post $post) {
        return $user->id == $post->created_by || $user->hasRole('admin') ;
    }

    public function destroy(User $user ,Post $post) {
        return $user->id == $post->created_by || $user->hasRole('admin');
    }
}
