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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Поле для заголовка
            $table->text('description')->nullable(); // Поле для описания
            $table->text('content')->nullable(); // Поле для содержания
            $table->string('image_url')->nullable(); // Поле для фото URL
            $table->decimal('price', 10, 2); // Поле для цены
            $table->timestamps(); // Поля для даты создания и обновления
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
