<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasualtiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('casualties', function($table)
        {
            $table->increments('id');
            $table->string('name', 100);

            $table->integer('emergency_id')->unsigned()->index();
            $table->foreign('emergency_id')->references('id')->on('emergencies')->onDelete('cascade');

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
		Schema::drop('casualties');
	}

}
