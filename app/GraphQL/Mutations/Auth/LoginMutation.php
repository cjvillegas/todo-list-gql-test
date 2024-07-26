<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class LoginMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'login',
        'description' => 'Authenticate a user'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('Login');
    }

    /**
     * @return array[]
     */
    public function args(): array
    {
        return [
            'email' => [
                "type" => Type::nonNull(Type::string()),
                "name" => "email"
            ],
            'password' => [
                "type" => Type::nonNull(Type::string()),
                "name" => "password"
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return array
     * @throws ValidationException
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        # grab a user by the provided email address
        $user = User::where('email', $args['email'])->first();

        # check if we have a user with the given email address
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No user found with this email.'],
            ]);
        }

        # check if the provided password match with the user password
        if (!Hash::check($args['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        # return the user and a fresh token
        return [
            "token" => $user->createToken('App')->plainTextToken,
            "user" => $user->refresh(),
        ];
    }
}
