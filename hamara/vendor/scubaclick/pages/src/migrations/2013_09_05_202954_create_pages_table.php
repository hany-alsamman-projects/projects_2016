<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$foreign = Config::get('pages::user_id_foreign');

		if(is_callable($foreign)) {
			$foreign = $foreign();
		}

		Schema::create('pages', function(Blueprint $table) use ($foreign)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->enum('status', ['published', 'draft']);
			$table->string('title', 255);
			$table->text('content');
			$table->text('description');
			$table->string('slug', 255)->unique();
			$table->integer('category_id')->unsigned()->nullable();
			$table->boolean('static')->default(0);
			$table->boolean('front')->default(0);
			$table->timestamps();
			$table->softDeletes();

	        $table->foreign('user_id')
	        	->references('id')
	        	->on($foreign);

	        $table->index('category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}
}
