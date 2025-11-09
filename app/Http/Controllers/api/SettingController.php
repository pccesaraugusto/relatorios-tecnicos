<?php

namespace App\Http\Controllers\api;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::all();
    }

    public function show($id)
    {
        return Setting::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|unique:settings,key',
            'value' => 'nullable',
            'type' => 'required|in:string,integer,boolean,json,text',
            'group' => 'nullable|string',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);
        return Setting::create($data);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $data = $request->validate([
            'value' => 'nullable',
            'type' => 'sometimes|required|in:string,integer,boolean,json,text',
            'group' => 'nullable|string',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);
        $setting->update($data);
        return $setting;
    }

    public function destroy($id)
    {
        Setting::destroy($id);
        return response()->noContent();
    }
}
