<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

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

		Schema::create('comments', function(Blueprint $table) use ($foreign)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('page_id')->unsigned();
			$table->string('name', 128);
			$table->string('email', 128);
			$table->string('website', 128)->nullable();
			$table->text('content');
			$table->string('ip', 255);
			$table->boolean('approved')->default(0);
			$table->boolean('spam')->default(0);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('page_id')
				->references('id')
				->on('pages')
				->onDelete('cascade');

	        $table->foreign('user_id')
	        	->references('id')
	        	->on($foreign);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
