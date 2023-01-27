<?php

namespace Ppranav\TableInsights\Utils;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class LastWeekActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder)
    {
        parent::__construct($builder);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereBetween(
                'created_at',
                [
                    Carbon::now()->subWeek()->startOfWeek(),
                    Carbon::now()->subWeek()->endOfWeek()
                ]
            );
    }

}
