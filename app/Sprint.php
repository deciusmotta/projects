<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['title','started_at','ended_at','released_at','acceptance','project_id'];

    protected $casts = [
        'started_at' => 'date:Y-m-d',
        'ended_at' => 'date:Y-m-d',
        'released_at' => 'date:Y-m-d',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
