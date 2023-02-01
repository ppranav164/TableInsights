<?php

namespace Ppranav\TableInsights\Utils;


use Illuminate\Database\Eloquent\Builder;

class AllActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $model, $date_column)
    {
        parent::__construct($model, $date_column);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder;
    }

}
