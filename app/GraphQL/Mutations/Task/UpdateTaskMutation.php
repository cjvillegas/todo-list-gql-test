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
class UpdateTaskMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'updateTask',
        'description' => 'Update a task'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('Task');
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
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return mixed
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): mixed
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $task = Task::findOrFail($args['id']);
        $task->update($args);

        return $task->refresh();
    }
}
