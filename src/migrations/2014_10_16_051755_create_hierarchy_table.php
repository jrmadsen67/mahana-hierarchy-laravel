<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHierarchyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hierarchy', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 55);
			$table->integer('parent_id')->nullable();
			$table->text('lineage')->nullable();
			$table->integer('deep');
			$table->softDeletes();
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
		Schema::drop('hierarchy');
	}

}
