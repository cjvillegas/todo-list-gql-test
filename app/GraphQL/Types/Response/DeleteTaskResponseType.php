<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Response;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class DeleteTaskResponseType extends GraphQLType
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'DeleteTaskResponse',
        'description' => 'A type used in deleting a task'
    ];

    /**
     * @return array[]
     */
    public function fields(): array
    {
        return [
            "message" => [
                'type' => Type::string(),
                'description' => "Response message"
            ],
            "id" => [
                "type" => Type::string(),
                "description" => "The task id to be deleted",
            ],
            "success" => [
                'type' => Type::boolean(),
                'description' => "Success indicator"
            ]
        ];
    }
}
