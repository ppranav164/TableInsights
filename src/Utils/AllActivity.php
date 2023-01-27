<?php

namespace Ppranav\TableInsights\Utils;


use Illuminate\Database\Eloquent\Builder;

class AllActivity extends Activity
{

    protected $builder;

    public function __construct(Builder $model)
    {
        parent::__construct($model);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder;
    }

}
