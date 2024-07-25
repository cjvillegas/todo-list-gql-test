<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class UserType extends GraphQLType
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'User',
        'description' => 'System user'
    ];

    /**
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The user ID. Auto-incremented.'
            ],
            "name" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "User full name",
            ],
            "email" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "User email",
            ]
        ];
    }
}
