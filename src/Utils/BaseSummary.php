<?php

namespace Ppranav\TableInsights\Utils;

use Illuminate\Database\Eloquent\Builder;
use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

 abstract class BaseSummary
{

    public $data = [];

    public function getInsights()
    {
        foreach($this->models() as $model => $date_column)
        {
            $models = (new ReflectionClass($model))->newInstance();

            $class_name = Str::snake(class_basename($models));

            foreach($this->getInsightsKeys() as $insight_key => $value)
            {
                if($this->canRetrive($insight_key))
                {
                    $this->data[$class_name][$insight_key] = $this->getSigleInsight($insight_key, $models, $date_column);
                }
            }
        }

        return $this->data;
    }

    public function analyze(Activity $activity): int
    {
        return $this->setQuery($activity)->count();
    }


    public function analyzeRawDaw(Activity $activity)
    {
        return $this->setQueryForRaw($activity)->result();
    }

    /**
	 * Add arrays of models
	 * @return array<Model, string>
	 */
    public abstract function models();


    /**
     * Set Model conditions
     * @param Activity  $activity
     * @return Builder
     */

    public abstract function setQuery(Activity $activity);

    /**
     * @param Activity  $activity
     * @return Activity
     */
    public function setQueryForRaw(Activity $activity)
    {
        return $activity;
    }

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


    public function getSigleInsight($insight_key, $models, $date_column)
    {
        switch($insight_key)
        {
            case 'total_records' : return $this->analyze(new AllActivity($models->query(), $date_column));
            case 'total_records_today' : return $this->analyze(new TodayActivity($models->query(), $date_column));
            case 'total_records_last_week' : return $this->analyze(new LastWeekActivity($models->query(), $date_column));
            case 'total_records_this_year': return $this->analyze(new YearlyActivity($models->query(), $date_column));
            case 'total_records_last_year': return $this->analyze(new LastYearActivity($models->query(), $date_column));
            case 'total_records_this_month': return $this->analyze(new MonthlyActivity($models->query(), $date_column));
            case 'total_records_each_month': return $this->analyzeRawDaw(new EachMonthActivity($models->query(), $date_column));
            default: return null;
        }
    }

}
