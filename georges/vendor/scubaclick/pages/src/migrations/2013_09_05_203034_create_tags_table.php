<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('slug', 255)->unique();
		});

		Schema::create('page_tag', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('tag_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
		Schema::drop('page_tag');
	}
}
