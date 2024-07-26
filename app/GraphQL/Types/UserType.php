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
            "first_name" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "User first name",
            ],
            "last_name" => [
                "type" => Type::string(),
                "description" => "User last name",
            ],
            "email" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "User email",
            ]
        ];
    }
}
