<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class EachMonthActivity extends Activity
{

    public $month_names = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    protected $builder;

    public function __construct(Builder $builder)
    {
        parent::__construct($builder);
        $this->setCondition();
    }

    public function setCondition(): Builder
    {
        return $this->builder;
    }


    public function result() : array
    {
        $logs = $this->builder->get()
                        ->groupBy(function($date) {
                            return Carbon::parse($date->created_at)->format('m');
                        });

        $log_data = [];
        $sumary = [];

        foreach ($logs as $key => $value) {
            $log_data[(int)$key] = count($value);
        }

        foreach($this->month_names as $key => $month)
        {
            $i = $key + 1;
            if(!empty($log_data[$i])){
                $sumary[$month] = $log_data[$i];
            }else{
                $sumary[$month] = 0;
            }
        }

        return $sumary;
    }

}
