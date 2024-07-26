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
class BulkDeleteTaskMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'bulkDeleteTask',
        'description' => 'Pass list of IDs to remove'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('BulkDeleteTaskResponse');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'ids' => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int())
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
        $deleted = Task::whereIn('id', $args['ids'])->delete();

        return [
            'message' => $deleted ? 'Tasks deleted' : 'Something went wrong',
            'success' => !!$deleted
        ];
    }
}
