<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06/03/18
 * Time: 12:21
 */

namespace App\Filters;


class ProjectFilter extends AbstractFilter
{
    protected $filters = 'search';

    protected function name($name)
    {
        return $this->builder->where('name', $name);
    }

    public function search($name){
        return $this->name($name);
    }

}