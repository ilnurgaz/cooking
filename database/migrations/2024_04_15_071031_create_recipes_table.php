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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->string('video');
            $table->integer('time_cook');
            $table->integer('number_servings');
            $table->text('ingredients');
            $table->text('recipes');
            $table->bigInteger('category')->unsigned();
            $table->foreign('category')->references('id')->on('categories');
            $table->integer('publish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
