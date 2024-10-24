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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer("number");
            $table->string("name");
            $table->float("height");
            $table->float("weight");
            $table->string("category");
            $table->unsignedBigInteger('type_prime_id')->nullable(); //PK
            $table->foreign('type_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('type_second_id')->nullable(); //PK
            $table->foreign('type_second_id')->references('id')->on('types'); //PK

            $table->string("stat_hp");
            $table->string("stat_attack");
            $table->string("stat_defense");
            $table->string("stat_special_attack");
            $table->string("stat_special_defense");
            $table->string("stat_speed");
            $table->string("description");
            $table->string("evolve_from")->nullable();
            $table->string("evolve_to")->nullable();
            $table->string("image_artwork");
            $table->string('image_front');
            $table->string('image_back');
            $table->string("cry");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
