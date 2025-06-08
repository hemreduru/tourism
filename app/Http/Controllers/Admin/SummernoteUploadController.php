<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SummernoteUploadController extends Controller
{
    /**
     * Summernote editör için resim yükleme
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        try {
            // Dosya kontrolü
            if (!$request->hasFile('image')) {
                return response()->json([
                    'success' => false,
                    'message' => __('editor.image_not_found')
                ], 400);
            }

            $image = $request->file('image');

            // Dosya türü kontrolü
            if (!in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                return response()->json([
                    'success' => false,
                    'message' => __('editor.invalid_image_type')
                ], 400);
            }

            // Dosya boyutu kontrolü (10MB)
            if ($image->getSize() > 10 * 1024 * 1024) {
                return response()->json([
                    'success' => false,
                    'message' => __('editor.image_size_too_large')
                ], 400);
            }

            // Klasör yapısı oluşturma
            $directory = 'images/summernote';
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            // Benzersiz dosya adı
            $uniqueFileName = Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Dosyayı kaydet
            $image->move(public_path($directory), $uniqueFileName);

            // Başarı yanıtı döndür
            return response()->json([
                'success' => true,
                'file' => [
                    'url' => asset($directory . '/' . $uniqueFileName),
                    'filename' => $uniqueFileName
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Summernote resim yükleme hatası: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('editor.error_uploading_image', ['error' => $e->getMessage()])
            ], 500);
        }
    }
}
