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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('company_name_en'); // Company name (en)
            $table->string('company_name_tr'); // Company name (tr)
            $table->string('company_name_nl'); // Company name (nl)
            $table->string('logo_path')->nullable(); // Logo
            $table->text('description_en')->nullable(); // Description (en)
            $table->text('description_tr')->nullable(); // Description (tr)
            $table->text('description_nl')->nullable(); // Description (nl)
            $table->string('website')->nullable(); // Website URL
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();
            $table->softDeletes(); // Soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
