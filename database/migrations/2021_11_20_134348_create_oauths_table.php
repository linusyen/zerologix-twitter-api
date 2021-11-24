<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateOauthsTable.
 */
class CreateOauthsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('oauths', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('platform');
            $table->string('platform_id');
            $table->string('token');
            $table->json('payload');
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
		Schema::drop('oauths');
	}
}
