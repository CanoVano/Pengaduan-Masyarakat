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
    Schema::create('reports', function (Blueprint $table) {
        $table->id(); // id 
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // user_id 
        $table->text('deskripsi'); // deskripsi 
        $table->string('foto_before'); // foto_before 
        $table->string('foto_after')->nullable(); // foto_after 
        $table->string('latitude'); // latitude 
        $table->string('longitude'); // longitude 
        $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])->default('Menunggu'); // status 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
