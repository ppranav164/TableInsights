<?php

namespace Ppranav\TableInsights;

use Illuminate\Support\ServiceProvider;

class TableInsightServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->publishes([__DIR__.'/config/tableinsights.php' => config_path('tableinsights.php')], 'tableinsights');

        $this->app->singleton('TableInsights', function($app){
            return new TableInsights;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
