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
            $table->longText('post_image')->nullable();
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('room_number')->nullable();
            $table->string('person_quantity')->nullable();
            $table->string('room_quantity')->nullable();
            $table->string('location')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('contact')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
