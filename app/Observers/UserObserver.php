<?php

namespace App\Observers;

use App\Models\User;
use Carbon\Carbon;

class UserObserver
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  User
     * @return void
     */
    public function created(User $user): void
    {
        $token = \Str::random(80);
        $hash = Carbon::now()->addDays(30);

        $user->api_token = $token;
        $user->expired_at = Carbon::now()->addDays(30);
        $user->save();
    }
}
