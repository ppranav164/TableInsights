<?php

namespace Ppranav\TableInsights\Utils;


use Illuminate\Database\Eloquent\Builder;

abstract class Activity
{
    protected $builder;

    public $date_column;

    public function __construct(Builder $builder, $date_column = 'created_at')
    {
        $this->builder = $builder;
        $this->setDateColumn($date_column);
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


    /**
     * Get the value of date_column
     */
    public function getDateColumn()
    {
        return $this->date_column;
    }

    /**
     * Set the value of date_column
     *
     * @return  self
     */
    public function setDateColumn($date_column)
    {
        $this->date_column = $date_column;

        return $this;
    }
}
