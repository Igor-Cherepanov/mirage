<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monuments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });

        Schema::create('monument_pictures', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('monuments_monument_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monument_id');
            $table->unsignedBigInteger('monument_picture_id');
            $table->timestamps();

            $table->foreign('monument_id')->references('id')->on('monuments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('monument_picture_id')->references('id')->on('monument_pictures')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('monument');
        Schema::dropIfExists('monument_pictures');
        Schema::dropIfExists('monuments_monument_pictures');
    }
}
