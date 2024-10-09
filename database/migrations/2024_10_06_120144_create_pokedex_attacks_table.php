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
        Schema::create('pokedex_attacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokedex_id')->nullable();
            $table->foreign('pokedex_id')->references('id')->on('pokedexes');
            $table->unsignedBigInteger('attack_id');
            $table->foreign('attack_id')->references('id')->on('attacks');
            $table->timestamps();
            $table->unique(["pokedex_id", "attack_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokedex_attacks');
    }
};
