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
        Schema::create('guru_details', function (Blueprint $table) {
            $table->id();

            $table->string('nip')->unique();
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->foreignId('guru_id')->nullable()->constrained()->on('guru_details')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropConstrainedForeignId('guru_id');
        });
        Schema::dropIfExists('guru_details');
    }
};
