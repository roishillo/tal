<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ParentActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        foreach ($model->parents as $parent) {
            $model->whereHas($parent, function ($query) {
                $query->where('is_active', true);
            });
        }
    }
}