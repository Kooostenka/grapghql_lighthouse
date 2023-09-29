<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;

final class Register
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $args['password'] = \Hash::make($args['password']);
        $user = User::create($args);
        return $user;
    }
}
