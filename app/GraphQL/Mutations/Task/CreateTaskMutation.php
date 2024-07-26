<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Task;

use App\Enums\Status;
use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Validation\Rule;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class CreateTaskMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'createTask',
        'description' => 'Create a new Task'
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
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The task title',
                'rules' => [
                    'string',
                    'required',
                    'max:255',
                    # this rule ensure that task title will be unique for each user
                    Rule::unique('tasks')->where(function ($query) {
                        return $query->where('created_by_id', auth()->user()->id);
                    }),
                ]
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
        # create and return a task
        return Task::create([
            ...$args,
            'status' => Status::ACTIVE->value,
            'created_by_id' => auth()->user()->id
        ]);
    }
}
