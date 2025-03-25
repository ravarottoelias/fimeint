<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function show()
    {
        $settings = Utils::getSettings();

        return view('admin.settings.edit', compact('settings'));
    }

    public function edit()
    {
        $settings = Utils::getSettings();


        return view('admin.settings.edit', compact('settings'));
    }

    public function save(Request $request)
    {
        // Get All Inputs Except '_Token' to loop through and save
        $settings = $request->except('_token');

        // Update All Settings
        foreach ($settings as $key => $value) {
            Setting::where('key', '=', $key)->update(['value' => $value]);
        }
        Session::flash('success', 'Los ajustes se guardaron con éxito.'); 
        return back();
    }
}
