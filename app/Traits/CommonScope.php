<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait CommonScope
{
    /**
     * The authenticated user scope
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function scopeAuthor(Builder $query)
    {
        $query->where('user_id', Auth::id());
    }
}
