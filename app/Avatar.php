<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $guarded = [];

    public function thumbnail()
    {
        return asset('storage/' . $this->thumbnail);
    }
}
