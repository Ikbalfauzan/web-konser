<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('konser_id')
                ->constrained('konser')
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah_tiket');
            $table->decimal('total_harga', 12, 2);

            $table->enum('status', [
                'menunggu',
                'berhasil',
                'dibatalkan'
            ])->default('berhasil');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};