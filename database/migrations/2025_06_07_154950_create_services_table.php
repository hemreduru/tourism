<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name_en'); // Hizmet adı (en)
            $table->string('service_name_tr'); // Hizmet adı (tr)
            $table->string('service_name_nl'); // Hizmet adı (nl)
            $table->string('image_path')->nullable(); // Fotoğraf alanı
            $table->text('short_description_en')->nullable(); // Kısa açıklama (en)
            $table->text('short_description_tr')->nullable(); // Kısa açıklama (tr)
            $table->text('short_description_nl')->nullable(); // Kısa açıklama (nl)
            $table->longText('content_en')->nullable(); // İçerik (en)
            $table->longText('content_tr')->nullable(); // İçerik (tr)
            $table->longText('content_nl')->nullable(); // İçerik (nl)
            $table->string('link')->nullable(); // Link
            $table->boolean('is_active')->default(true); // Aktif mi
            $table->timestamps();
            $table->softDeletes(); // Yumuşak silme
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
