<?php

namespace App\Repositories;

use App\Models\Faq;
use Illuminate\Support\Facades\Log;

class FaqRepository
{
    public function all()
    {
        return Faq::query();
    }

    public function create(array $data)
    {
        try {
            return Faq::create($data);
        } catch (\Exception $e) {
            Log::error('FAQ Create Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(Faq $faq, array $data)
    {
        try {
            $faq->update($data);
            return $faq;
        } catch (\Exception $e) {
            Log::error('FAQ Update Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function delete(Faq $faq)
    {
        try {
            $faq->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('FAQ Delete Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
