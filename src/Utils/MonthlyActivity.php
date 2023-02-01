<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;

class MonthlyActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder, $date_column)
    {
        parent::__construct($builder, $date_column);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereMonth($this->date_column, date('m'))
                             ->whereYear($this->date_column, date('Y'));
    }

}
