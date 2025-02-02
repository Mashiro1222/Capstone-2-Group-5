<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetectionHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('detection_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('item_name');
            $table->string('scientific_name')->nullable();
            $table->text('possible_allergen')->nullable();
            $table->text('essential_information')->nullable();
            $table->text('symptoms')->nullable();
            $table->timestamps();

            // Foreign key for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detection_histories');
    }
}
