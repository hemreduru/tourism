<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPreferenceRequest;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserPreferenceController extends Controller
{
    /**
     * Display the user preferences form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        $preferences = $user->preferences ?? new UserPreference();

        // Kullanıcının tercihleri yoksa, varsayılan değerleri kullan
        if (!$user->preferences) {
            $preferences->fill(UserPreference::getDefaults());
        }

        return view('admin.preferences.edit', compact('preferences'));
    }

    /**
     * Update the user's preferences.
     *
     * @param  \App\Http\Requests\UpdateUserPreferenceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserPreferenceRequest $request)
    {
        $user = Auth::user();

        // Checkbox değerlerini işle - işaretlenmeyenler requestte olmaz, bunları false olarak ayarla
        $data = $request->validated();

        // Boolean alanları kontrol et, yoksa false olarak ayarla
        $booleanFields = ['dark_mode', 'layout_boxed', 'layout_fixed_sidebar', 'layout_fixed_navbar', 'layout_fixed_footer', 'sidebar_collapsed'];

        foreach ($booleanFields as $field) {
            if (!isset($data[$field])) {
                $data[$field] = false;
            }
        }
        try {
            DB::beginTransaction();
            // Kullanıcının tercihleri yoksa oluştur, varsa güncelle
            if (!$user->preferences) {
                $preferences = new UserPreference($data);
                $preferences->user_id = $user->id;
                $preferences->save();

                // User nesnesini yenile ki ilişki doğru çalışsın
                $user->refresh();
            } else {
                $user->preferences->update($data);
            }
            DB::commit();

            return redirect()->route('admin.preferences.edit')
                ->with('success', __('preferences.updated_successfully'));

        } catch (\Exception $e) {
            Log::error("User preference update failed. User ID: {$user->id}. Error: {$e->getMessage()}. Trace: {$e->getTraceAsString()}");

            DB::rollBack();
            return redirect()->route('admin.preferences.edit')
                ->with('error', __('preferences.update_failed'));
        }
    }
}
