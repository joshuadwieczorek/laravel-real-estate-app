<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.a
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
	        $table->string('description');
	        $table->float('price', '18')->default(0.00);
	        $table->enum('purchase_rent', ['purchase', 'rent']);
	        $table->tinyInteger('bedrooms')->default(0);
	        $table->tinyInteger('bathrooms')->default(0);
	        $table->smallInteger('square_feet')->default(0);
	        $table->string('address1')->nullable();
	        $table->string('address2')->nullable();
	        $table->string('city')->nullable();
	        $table->string('state')->nullable();
	        $table->integer('zip')->nullable();
	        $table->string('listing_agent')->nullable();
	        $table->text('details')->nullable();
	        $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
