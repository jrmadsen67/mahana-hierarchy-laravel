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
		Schema::create(\Config::get('mahana-hierarchy-laravel::hierarchy.table'), function(Blueprint $table)
		{
			$table->increments(\Config::get('mahana-hierarchy-laravel::hierarchy.primary_key'));
			$table->string(\Config::get('mahana-hierarchy-laravel::hierarchy.name'), 55);
			$table->integer(\Config::get('mahana-hierarchy-laravel::hierarchy.parent_id'))->nullable();
			$table->text(\Config::get('mahana-hierarchy-laravel::hierarchy.lineage'))->nullable();
			$table->integer(\Config::get('mahana-hierarchy-laravel::hierarchy.deep'));
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
		Schema::drop(\Config::get('mahana-hierarchy-laravel::hierarchy.table'));
	}

}
