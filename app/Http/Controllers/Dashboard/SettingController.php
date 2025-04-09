<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingsRequest;

class SettingController extends Controller
{
    public function setting()
    {
        return view('dashboard.Settings.index');
    }


    public function settingUpdate(SettingsRequest $request)
    {
        $requestData = $request->validated();
        if ($request->logo) {
            $logo = $request->file('logo');
            $logoPath = str_replace('\\/', '/', setting('logo'));

            if (file_exists(public_path($logoPath))) unlink(public_path($logoPath));
            $destinationPath = public_path() . '/uploads/settings/';
            $extension = $logo->getClientOriginalExtension(); // getting logo extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renaming logo
            $logo->move($destinationPath, $name); // uploading file to given
            $requestData['logo'] = 'uploads/settings/' . $name;
        }

        setting($requestData)->save();

        return redirect()->route('dashboard.settings.index')->with(['status' => 'success', 'message' => __('dashboard.updatedSuccessfully')]);

    }// end of store


}
