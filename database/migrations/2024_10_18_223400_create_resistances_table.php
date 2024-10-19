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
        Schema::create('resistances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokemon_id')->nullable(); //PK
            $table->foreign('pokemon_id')->references('id')->on('pokemon'); //PK
            $table->float('normal');
            $table->float('plante');
            $table->float('feu');
            $table->float('eau');
            $table->float('electrik');
            $table->float('glace');
            $table->float('combat');
            $table->float('poison');
            $table->float('sol');
            $table->float('vol');
            $table->float('psy');
            $table->float('insecte');
            $table->float('roche');
            $table->float('spectre');
            $table->float('dragon');
            $table->float('tenebres');
            $table->float('acier');
            $table->float('fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resistances');
    }
};
