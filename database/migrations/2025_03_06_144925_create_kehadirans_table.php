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
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpha']);
            $table->string('keterangan')->nullable();

            $table->foreignId('siswa_id')->constrained()->on('siswa_details')->cascadeOnDelete();
            $table->foreignId('verified_by')->nullable()->constrained()->on('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
