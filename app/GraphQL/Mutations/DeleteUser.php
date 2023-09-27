<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;

final class DeleteUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::findOrFail($args['id']);
        $status = $user->delete();

        return [
            'status' => $status,
            'message' => 'User deleted!'
        ];
    }
}
