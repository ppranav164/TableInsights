<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;

class YearlyActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder)
    {
        parent::__construct($builder);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereYear('created_at', date('Y'));
    }

}
