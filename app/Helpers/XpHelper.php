<?php

namespace App\Helpers;

use App\Models\User;

class XpHelper
{
    public static function addXP(User $user, int $amount)
    {
        $user->xp += $amount;

        // Level up = setiap 100 XP
        $user->level = floor($user->xp / 100) + 1;

        $user->save();
    }
}
