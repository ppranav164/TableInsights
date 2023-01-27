<?php

namespace Ppranav\TableInsights\Utils;


use Illuminate\Database\Eloquent\Builder;

abstract class Activity
{
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public abstract function setCondition() : Builder;

    public function count() : int
    {
        return $this->builder->count();
    }

    public function query() : Builder
    {
        return $this->builder;
    }

}
