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
        Schema::create('treatment_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('treatment_type_en');
            $table->string('treatment_type_tr');
            $table->string('treatment_type_nl');
            $table->string('before_image_path');
            $table->string('after_image_path');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_galleries');
    }
};
