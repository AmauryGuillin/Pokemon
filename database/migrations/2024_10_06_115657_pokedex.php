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
        Schema::create('pokedexes', function (Blueprint $table) {
            $table->id();
            $table->integer("number");
            $table->string("name");
            $table->string("height");
            $table->string("weight");
            $table->string("category");
            $table->string("talent");
            $table->unsignedBigInteger('type_prime_id'); //PK
            $table->foreign('type_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('type_second_id'); //PK
            $table->foreign('type_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_prime_id'); //PK
            $table->foreign('weakness_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_second_id'); //PK
            $table->foreign('weakness_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_tertiary_id'); //PK
            $table->foreign('weakness_tertiary_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_prime_id'); //PK
            $table->foreign('strengh_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_second_id'); //PK
            $table->foreign('strengh_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_tertiary_id'); //PK
            $table->foreign('strengh_tertiary_id')->references('id')->on('types'); //PK
            $table->string("stat_hp");
            $table->string("stat_attack");
            $table->string("stat_defense");
            $table->string("stat_special_attack");
            $table->string("stat_special_defense");
            $table->string("stat_speed");



            //$table->string("attack_id"); //PK
            $table->foreignId('attack_id')->constrained();



            $table->string("pokemon_description");
            $table->string("evolve_from");
            $table->string("evolve_to");
            $table->string("pokemon_cry");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokedexes');
    }
};
