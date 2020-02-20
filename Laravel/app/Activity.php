<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'module_id', 'description', 'status',
    ];

    public function module () {
        return $this->belongsTo(Module::class);
    }
}
