<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class TaskQuery extends Query
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'task',
        'model' => Task::class
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
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Task::findOrFail($args['id']);
    }
}
