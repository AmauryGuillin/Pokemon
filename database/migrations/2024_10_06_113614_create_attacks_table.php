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
        Schema::create('attacks', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger('type_id')->nullable(); //PK
            $table->foreign('type_id')->references('id')->on('types'); //PK
            $table->integer("pp");
            $table->integer("power")->nullable();
            $table->integer("accuracy")->nullable();
            $table->string("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attacks');
    }
};
