<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'title', 'description', 'status',
    ];

    public function activity () {
        return $this->hasMany(Activity::class);
    }
}
