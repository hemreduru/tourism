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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ad Soyad
            $table->string('email'); // E-posta
            $table->string('phone')->nullable(); // Telefon
            $table->date('date'); // Tarih
            $table->string('time_slot'); // Saat aralığı

            // Mesaj içeriği - her dil için ayrı
            $table->text('message_en')->nullable();
            $table->text('message_tr')->nullable();
            $table->text('message_nl')->nullable();

            // Durum - status tablosuna foreign key
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');

            // Diğer alanlar
            $table->string('language', 10)->default('tr'); // Mesajın dili
            $table->boolean('is_read')->default(false); // Okundu durumu
            $table->boolean('is_responded')->default(false); // Yanıtlandı durumu

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
