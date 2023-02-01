<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;

class TodayActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder, $date_column)
    {
        parent::__construct($builder, $date_column);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereDay($this->date_column, date('d'))
            ->whereYear($this->date_column, date('Y'));
    }

}
