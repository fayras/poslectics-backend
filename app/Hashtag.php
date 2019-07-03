<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $guarded = [];

    function pos() {
        return $this->belongsTo(Pos::class);
    }
}
