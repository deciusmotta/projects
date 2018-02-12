<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','description'];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
