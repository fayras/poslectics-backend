<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $guarded = [];

    function hashtags() {
        return $this->hasMany(Hashtag::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
