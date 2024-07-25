<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

/**
 * @author Chaprel John Villegas <jv@synqup.com>
 */
class LogoutMutation extends Mutation
{
    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'logout',
        'description' => 'Destroy token'
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::string();
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return string
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): string
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        // Revoke the token that was used to authenticate the current request...
        auth()->user()->currentAccessToken()->delete();

        return 'Logout successful';
    }
}
