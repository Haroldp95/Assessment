<?php
namespace App\Helpers;

use App\Models\User;

class PostHelper
{
    // Access user data from post->user_id.
    public static function getUserName($userId)
    {
        $user = User::find($userId);

        return $user ? $user->name : 'User Not Found';
    }
}

