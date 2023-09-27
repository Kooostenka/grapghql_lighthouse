<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;

final class UpdateUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $user = User::findOrFail($args['id']);
       unset($args['id']);
       $user->update($args);

       return $user;
    }
}
