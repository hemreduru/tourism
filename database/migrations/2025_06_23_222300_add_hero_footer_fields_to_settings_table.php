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
        Schema::table('settings', function (Blueprint $table) {
            // Hero section texts
            $table->text('hero_heading_en')->nullable()->after('address_nl');
            $table->text('hero_heading_tr')->nullable()->after('hero_heading_en');
            $table->text('hero_heading_nl')->nullable()->after('hero_heading_tr');

            $table->text('hero_description_en')->nullable()->after('hero_heading_nl');
            $table->text('hero_description_tr')->nullable()->after('hero_description_en');
            $table->text('hero_description_nl')->nullable()->after('hero_description_tr');

            // Top footer texts
            $table->string('top_footer_heading_en')->nullable()->after('hero_description_nl');
            $table->string('top_footer_heading_tr')->nullable()->after('top_footer_heading_en');
            $table->string('top_footer_heading_nl')->nullable()->after('top_footer_heading_tr');

            $table->string('top_footer_lead_en')->nullable()->after('top_footer_heading_nl');
            $table->string('top_footer_lead_tr')->nullable()->after('top_footer_lead_en');
            $table->string('top_footer_lead_nl')->nullable()->after('top_footer_lead_tr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_heading_en',
                'hero_heading_tr',
                'hero_heading_nl',
                'hero_description_en',
                'hero_description_tr',
                'hero_description_nl',
                'top_footer_heading_en',
                'top_footer_heading_tr',
                'top_footer_heading_nl',
                'top_footer_lead_en',
                'top_footer_lead_tr',
                'top_footer_lead_nl',
            ]);
        });
    }
};
