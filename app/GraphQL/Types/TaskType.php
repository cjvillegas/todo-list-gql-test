<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class TaskType extends GraphQLType
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A type for task data'
    ];

    /**
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The task ID. Auto-incremented.'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The task title'
            ],
            'status' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The task status. 1 for active, 2 for done.'
            ]
        ];
    }
}
