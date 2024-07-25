<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Auth;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Auth\Authenticatable;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class WhoAmIQuery extends Query
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'whoAmI',
        'description' => 'Get currently authenticated user'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('User');
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Authenticatable|null
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): ?Authenticatable
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return auth()->user();
    }
}
