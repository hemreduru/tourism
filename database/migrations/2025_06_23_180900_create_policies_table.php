<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['privacy', 'terms', 'gdpr']);
            $table->string('title_en');
            $table->string('title_tr');
            $table->string('title_nl');
            $table->longText('content_en');
            $table->longText('content_tr');
            $table->longText('content_nl');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
