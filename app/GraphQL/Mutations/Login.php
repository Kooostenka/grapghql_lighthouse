<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = \Auth::guard();

        if( ! $guard->attempt($args)) {
            throw new \Error('Invalid credentials.');
        }


        $user = $guard->user();

        return $user;
    }
}
