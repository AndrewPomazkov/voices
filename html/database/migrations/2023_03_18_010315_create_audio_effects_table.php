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
            $table->string('effect_type');
            $table->text('effect_parameters')->nullable();
            $table->timestamps();

            $table->foreign('audio_id')->references('id')->on('audio')->onDelete('cascade');
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
