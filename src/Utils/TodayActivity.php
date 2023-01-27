<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;

class TodayActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $builder)
    {
        parent::__construct($builder);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder->whereDay('created_at', date('d'));
    }

}
