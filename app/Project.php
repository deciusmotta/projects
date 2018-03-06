<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ProjectFilter;
class Project extends Model
{
    protected $fillable = ['name','description'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }

    public function repos()
    {
        return $this->hasMany(Repo::class);
    }

    public function scopeFilter($query, ProjectFilter $filters)
    {
        return $filters->apply($query);
    }
}
