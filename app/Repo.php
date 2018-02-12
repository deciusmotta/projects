<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{
    protected $fillable = ['project_id','provider_id','url'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
