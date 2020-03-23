<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            /**
             * Ther is always question:
             * Should this go to users table
             * Answer is:
             * Maybe
             * That is important thing to consider with this relation (One to many)
             * Is this usefull?
             */
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('website_url');
            $table->string('github_url');
            $table->string('twitter_url');
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
        Schema::dropIfExists('profiles');
    }
}
