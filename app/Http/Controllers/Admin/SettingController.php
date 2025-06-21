<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Show the settings form.
     */
    public function edit()
    {
        $setting = Setting::first();

        // Eğer henüz kayıt yoksa, varsayılan değerlerle oluştur
        if (!$setting) {
            $setting = Setting::create();
        }

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the settings record.
     */
    public function update(SettingRequest $request)
    {
        $setting = Setting::first();

        DB::beginTransaction();
        try {
            $setting->update($request->validated());
            DB::commit();
            Log::info('Settings updated by user id: ' . auth()->id());

            return back()->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Settings update failed: ' . $e->getMessage());

            return back()->withInput()->with('error', __('common.error_updating'));
        }
    }
}
