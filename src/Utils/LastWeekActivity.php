<?php

namespace Ppranav\TableInsights\Utils;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class LastWeekActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder, $date_column)
    {
        parent::__construct($builder, $date_column);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereBetween(
            $this->date_column,
            [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ]
        )->whereYear($this->date_column, date('Y'));
    }

}
