<?php

    namespace Cartalyst\Sentinel\Bans;

use Illuminate\Database\Eloquent\Model;

class EloquentBan extends Model
{
    protected $table = 'throttle';

    protected $fillable = [
        'user_id',
        'type',
        'suspended',
        'banned',
        'suspended_at',
        'banned_at'
    ];

    public function getisBannedAttribute($isBanned)
    {
        return (bool) $isBanned;
    }

    public function setisBannedAttribute($isBanned)
    {
        $this->attributes['banned'] = (bool) $isBanned;
    }

}
