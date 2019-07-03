<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    function pos() {
        return $this->belongsTo(Pos::class);
    }
}
