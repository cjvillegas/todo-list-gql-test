<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Task;

use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class DeleteTaskMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'deleteTask',
        'description' => 'Delete a task'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('DeleteTaskResponse');
    }

    /**
     * @return array[]
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id()
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
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        # delete a task
        $deleted = Task::destroy($args['id']);

        return [
            'message' => $deleted ? 'Task deleted successfully' : 'Task not found',
            'id' => $args['id'],
            'success' => $deleted
        ];
    }
}
