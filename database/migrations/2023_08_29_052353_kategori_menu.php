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
        Schema::create('kategori_menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('harga');
            $table->foreignId('kategori_menu_id')->constrained('kategori_menu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_menu');
        Schema::dropIfExists('menu');
    }
};
