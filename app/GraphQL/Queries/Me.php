<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

final class Me
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = \Auth::guard()->user();

        if (null == $user) {
            throw new \Error('User unauth');
        }

        return $user;
    }
}
