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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id'); // ID anak
            $table->string('activity_type'); // Jenis aktivitas (makan, tidur, minum susu, dll.)
            $table->string('description'); // Deskripsi aktivitas
            $table->dateTime('time'); // Waktu aktivitas
            $table->string('status')->nullable(); // Status (selesai, durasi, dll.)
            $table->timestamps();
            
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
