<?php

use App\Settings\GeneralSettings;

if (!function_exists('generalSettings')) {
    function generalSettings()
    {
       $generalSettings = app(GeneralSettings::class);

        return $generalSettings;        
    }
}
