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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_tr');
            $table->string('name_nl');
            $table->string('title_en')->nullable();
            $table->string('title_tr')->nullable();
            $table->string('title_nl')->nullable();
            $table->text('comment_en')->nullable();
            $table->text('comment_tr')->nullable();
            $table->text('comment_nl')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
