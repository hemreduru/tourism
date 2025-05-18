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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('dark_mode')->default(false);
            $table->string('sidebar_color')->default('sidebar-dark-primary');
            $table->string('navbar_color')->default('navbar-white navbar-light');
            $table->string('accent_color')->default('primary');
            $table->string('layout_boxed')->nullable();
            $table->string('layout_fixed_sidebar')->nullable();
            $table->string('layout_fixed_navbar')->nullable();
            $table->string('layout_fixed_footer')->nullable();
            $table->boolean('sidebar_collapsed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
