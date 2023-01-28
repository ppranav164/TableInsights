<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TableInsights Key Naming
    |--------------------------------------------------------------------------
    |
    | Here, you can customize the key names of your PHP array to better suit your needs.
    | Simply add the desired key name in the right field that you want to replace
    |
    */

    'total_records'            => 'total_records',
    'total_records_today'      => 'total_records_today',
    'total_records_last_week'  => 'total_records_last_week',
    'total_records_this_year'  => 'total_records_this_year',
    'total_records_last_year'  => 'total_records_last_year',
    'total_records_this_month' => 'total_records_this_month',

    /*
    |--------------------------------------------------------------------------
    | Individual TableInsights Setting
    |--------------------------------------------------------------------------
    |
    | Here, you can enable or disable individual keys to better suit your needs.
    |
    */

   'settings' => [
        'total_records'            => true,
        'total_records_today'      => false,
        'total_records_last_week'  => false,
        'total_records_this_year'  => false,
        'total_records_last_year'  => false,
        'total_records_this_month' => false
   ]

];
