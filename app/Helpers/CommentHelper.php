<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\User;

class CommentHelper
{
    /**
     * Get a user by ID.
     *
     * @param int $userId The ID of the user.
     * @return User|null
     */
    public static function formateDate(string $date)
    {
        return Carbon::parse($date)->format('F d, Y');
    }
     /**
     * Get a user by ID.
     *
     * @param int $userId The ID of the user.
     * @return User|null
     */
    public static function getUserById(int $userId): ?User
    {
        $user = User::find($userId);

        return $user;
    }
}