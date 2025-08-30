<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id(); 
            $table->text('nombre'); 
            $table->string('tamano', 200); 
            $table->string('tipo', 200); 
            $table->text('documento'); 
            $table->json('data')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
