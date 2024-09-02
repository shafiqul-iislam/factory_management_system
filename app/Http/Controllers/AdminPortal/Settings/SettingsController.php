<?php

namespace App\Http\Controllers\AdminPortal\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;

class SettingsController extends Controller
{
    protected $generalSettings;
    public function __construct(GeneralSettings $generalSettings)
    {
        // #
    }

    public function index()
    {
        $data['generalSettings'] = $this->generalSettings;

        return view('theme.admin_portal.settings.all_settings', $data);
    }

    public function updateGeneralSettings(Request $request) {}
}
