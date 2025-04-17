<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public $company_name;    
    public $site_name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $country;
    public $zip_code;
    public $currency;
    public $timezone;
    public $logo;
    public $favicon;

    public static function group(): string
    {
        return 'general';
    }
}