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
        $validator = \Validator::make($args, [
            'name' => 'required|min:1',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if($validator->fails()){
            throw new \Error('Unable to register');
        }

        $args['password'] = \Hash::make($args['password']);
        $user = User::create($args);
        return $user;
    }
}
