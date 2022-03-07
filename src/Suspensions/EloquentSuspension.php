<?php

namespace Cartalyst\Sentinel\Suspensions;

use Illuminate\Database\Eloquent\Model;

class EloquentSuspension extends Model
{
    protected $table = 'throttle';

    protected static $suspensionTime = 15;

    protected $fillable = [
        'user_id',
        'suspended',
        'banned',
        'suspended_at',
        'banned_at'
    ];

    public function getSuspendedAttribute($suspended)
    {
        return (bool) $suspended;
    }

    public function setSuspendedAttribute($suspended)
    {
        $this->attributes['suspended'] = (bool) $suspended;
    }
}
