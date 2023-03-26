<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_effects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audio_id');
            $table->unsignedBigInteger('effect_id');
            $table->json('filters');
            $table->timestamps();

            $table->foreign('audio_id')
                ->references('id')
                ->on('audio')
                ->onDelete('cascade');

            $table->foreign('effect_id')
                ->references('id')
                ->on('effects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_effects');
    }
};
