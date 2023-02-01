<?php

namespace Ppranav\TableInsights;


use Illuminate\Database\Eloquent\Builder;
use Ppranav\TableInsights\Interfaces\TableDataInsights;
use Ppranav\TableInsights\Utils\Activity;
use Ppranav\TableInsights\Utils\BaseSummary;

abstract class TableInsights extends BaseSummary implements TableDataInsights
{

     /**
     * Set Model conditions
     * @param Activity  $activity
     * @return Builder
     */
    public function setQuery(Activity $activity)
    {
        return $activity->query();
    }

}
