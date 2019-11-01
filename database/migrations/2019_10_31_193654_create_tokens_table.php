<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id');
            $table->string('token');
	        $table->string('type')->default(1);
	        $table->boolean('expired')->default(false);
	        $table->timestamp('expires_at');
            $table->timestamps();
        });

        Schema::table('tokens', function(Blueprint $table) {
        	$table->foreign('user_id')
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
        Schema::dropIfExists('tokens');
    }
}
