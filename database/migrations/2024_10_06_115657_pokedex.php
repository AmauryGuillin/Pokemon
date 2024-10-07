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
            $table->float("height");
            $table->float("weight");
            $table->string("category");
            $table->unsignedBigInteger('type_prime_id')->nullable(); //PK
            $table->foreign('type_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('type_second_id')->nullable(); //PK
            $table->foreign('type_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_prime_id')->nullable(); //PK
            $table->foreign('weakness_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_second_id')->nullable(); //PK
            $table->foreign('weakness_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_tertiary_id')->nullable(); //PK
            $table->foreign('weakness_tertiary_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_fourth_id')->nullable(); //PK
            $table->foreign('weakness_fourth_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_fifth_id')->nullable(); //PK
            $table->foreign('weakness_fifth_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('weakness_sixth_id')->nullable(); //PK
            $table->foreign('weakness_sixth_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_prime_id')->nullable(); //PK
            $table->foreign('strengh_prime_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_second_id')->nullable(); //PK
            $table->foreign('strengh_second_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_tertiary_id')->nullable(); //PK
            $table->foreign('strengh_tertiary_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_fourth_id')->nullable(); //PK
            $table->foreign('strengh_fourth_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_fifth_id')->nullable(); //PK
            $table->foreign('strengh_fifth_id')->references('id')->on('types'); //PK
            $table->unsignedBigInteger('strengh_sixth_id')->nullable(); //PK
            $table->foreign('strengh_sixth_id')->references('id')->on('types'); //PK
            $table->string("stat_hp");
            $table->string("stat_attack");
            $table->string("stat_defense");
            $table->string("stat_special_attack");
            $table->string("stat_special_defense");
            $table->string("stat_speed");
            $table->foreignId('attack_id')->nullable()->constrained(); //PK
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
        Schema::dropIfExists('pokedexes');
    }
};
