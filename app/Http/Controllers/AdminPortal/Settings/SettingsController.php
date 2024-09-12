<?php

namespace App\Http\Controllers\AdminPortal\Settings;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        // #
    }

    public function index(GeneralSettings $generalSettings)
    {
        $data['generalSettings'] = $generalSettings;

        return view('theme.admin_portal.settings.all_settings', $data);
    }

    public function updateGeneralSettings(Request $request, GeneralSettings $generalSettings)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $generalSettings->company_name = $request->company_name;
        $generalSettings->site_name = $request->site_name;
        $generalSettings->email = $request->email;
        $generalSettings->phone = $request->phone;
        $generalSettings->country = $request->country;
        $generalSettings->city = $request->city;
        $generalSettings->address = $request->address;
        $generalSettings->zip_code = $request->zip_code;
        $generalSettings->timezone = $request->time_zone;
        $generalSettings->currency = $request->currency;
        $generalSettings->save();
        return redirect()->back()->with('success', 'Settings Updated Successfully');
    }

    public function uploadLogo(Request $request, GeneralSettings $generalSettings)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // ########### interinvention image upload #########        
        $logo = $request->file('logo');
        $logo = time() . '.' . $logo->getClientOriginalExtension();

        $logoResize = Image::make($logo)->resize(100, 70, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Define the path where you want to store the image
        $path = public_path('/logo' . $logo);
        $logoResize->save($path);



        // ############# normal image upload ########
        // $imageName = time() . '.' . $request->logo->extension();
        // $request->logo->storeAs('/logo', $imageName);

        $generalSettings->logo = $logo;
        $generalSettings->save();
        return redirect()->back()->with('success', 'Logo Updated Successfully');
    }
}
