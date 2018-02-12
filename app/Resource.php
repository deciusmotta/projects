<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name','description','value'];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
