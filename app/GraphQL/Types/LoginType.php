<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class LoginType extends GraphQLType
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'Login',
        'description' => 'A type'
    ];

    /**
     * @return array[]
     */
    public function fields(): array
    {
        return [
            "user" => [
                'type' => GraphQL::type('User'),
                'description' => "System user"
            ],
            "token" => [
                "type" => Type::string(),
                "description" => "Name of user",
            ]
        ];
    }
}
