<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('videos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('slug', 64)->unique();
			$table->text('description');
			$table->timestamp('published_at')->nullable();
			$table->timestamp('recorded_at')->nullable();
			$table->string('youtube_id', 16)->unique();
			$table->unsignedInteger('channel_id')->nullable()->references('id')->on('channels')->onUpdate('cascade')->onDelete('set null');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('videos');
	}

}
