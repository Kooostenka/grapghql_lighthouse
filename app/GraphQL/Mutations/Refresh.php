<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Carbon\Carbon;

final class Refresh
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = \Auth::guard()->user();

        $user->api_token = \Str::random(80);
        $user->expired_at = Carbon::now()->addDays(30);

        $user->save();

        return $user;
    }
}
