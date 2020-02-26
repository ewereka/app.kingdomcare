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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('review_by_id');
            $table->unsignedBigInteger('review_for_id');
            $table->tinyInteger('rating')->unsigned();
            $table->boolean('rating_hidden')->default(false);
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('review_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('review_for_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('reviews');
    }
}
