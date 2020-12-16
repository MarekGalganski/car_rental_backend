<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();

            $table->unsignedTinyInteger('rating');
            $table->text('content');

            $table->unsignedBigInteger('car_id')->index();
            $table->foreign('car_id')->references('id')->on('cars');

            $table->unsignedBigInteger('car_booking_id')->nullable();
            $table->foreign('car_booking_id')->references('id')->on('car_bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
