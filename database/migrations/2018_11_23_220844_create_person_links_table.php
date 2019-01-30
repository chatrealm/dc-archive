<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonLinksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('person_links', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('person_id')->references('id')->on('people')->onUpdate('cascade')->onDelete('cascade');
			$table->string('service')->nullable();
			$table->string('label')->nullable();
			$table->text('service_data')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('person_links');
	}

}
