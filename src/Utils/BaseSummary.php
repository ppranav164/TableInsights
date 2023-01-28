<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;
use ReflectionClass;
use Illuminate\Support\Str;
 abstract class BaseSummary
{

    public $data = [];

    public function getInsights()
    {
        foreach($this->models() as $model)
        {
            $models = (new ReflectionClass($model))->newInstance();

            $class_name = Str::snake(class_basename($models));

            foreach($this->getInsightsKeys() as $insight_key => $value)
            {
                if($this->canRetrive($insight_key))
                {
                    $this->data[$class_name][$insight_key] = $this->getSigleInsight($insight_key, $models);
                }
            }
        }

        return $this->data;
    }

    public function analyze(Activity $activity): int
    {
        return $this->setQuery($activity)->count();
    }


    /**
     * Add models as array
     * @return array
     */
    public abstract function models();

    /**
     * Set Model conditions
     * @param Activity  $activity
     * @return Builder
     */

    public abstract function setQuery(Activity $activity);


     /**
     * Get TableInsights instance
     * @return $this
     */
    public function tableInsights()
    {
        return $this;
    }

    protected function getInsightsKey($key)
    {
        return config('tableinsights')[$key];
    }


    protected function canRetrive($key): bool
    {
        $settings = config('tableinsights.settings');
        return isset($settings[$key]) && $settings[$key] == true;
    }


    protected function getInsightsKeys()
    {
        return config('tableinsights.settings');
    }


    public function getSigleInsight($insight_key, $models)
    {
        switch($insight_key)
        {
            case 'total_records' : return $this->analyze(new AllActivity($models->query()));
            case 'total_records_today' : return $this->analyze(new TodayActivity($models->query()));
            case 'total_records_last_week' : return $this->analyze(new LastWeekActivity($models->query()));
            case 'total_records_this_year': return $this->analyze(new YearlyActivity($models->query()));
            case 'total_records_last_year': return $this->analyze(new LastYearActivity($models->query()));
            case 'total_records_this_month': return $this->analyze(new MonthlyActivity($models->query()));
            default: return null;
        }
    }

}
