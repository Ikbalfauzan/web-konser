<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konser', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konser');
            $table->string('artis');
            $table->string('lokasi');
            $table->dateTime('tanggal');
            $table->decimal('harga_tiket', 12, 2);
            $table->unsignedInteger('stok_tiket')->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konser');
    }
};