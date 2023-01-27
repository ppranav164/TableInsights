<?php

namespace Ppranav\TableInsights\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Ppranav\TableInsights\Utils\Activity;

interface TableDataInsights
{
     /**
     * Set Model conditions
     * @param Activity  $activity
     * @return Builder
     */
     public function setQuery(Activity $activity);
}
