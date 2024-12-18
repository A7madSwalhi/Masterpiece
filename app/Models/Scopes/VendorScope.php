<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class VendorScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $vendor = Auth::guard('vendor')->user();

        if($vendor && $vendor->id){
            $builder->where('vendor_id' , '=' , $vendor->id);
        }
    }
}
