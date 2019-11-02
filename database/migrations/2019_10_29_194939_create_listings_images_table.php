<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('listing_id');
            $table->string('url');
	        $table->string('path');
	        $table->string('title');
	        $table->string('alt')->nullable();
	        $table->string('caption')->nullable();
            $table->timestamps();
        });

        Schema::table('listings_images', function(Blueprint $table) {
	        $table->foreign('listing_id')
		        ->references('id')
		        ->on('listings')
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
        Schema::dropIfExists('listings_images');
    }
}
