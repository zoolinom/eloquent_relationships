<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likables', function (Blueprint $table) {
            $table->primary(['user_id', 'likable_id', 'likable_type']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('likable_id'); // 1 or 2 or 3
            $table->string('likable_type'); // App\Comment or App\Post
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
        Schema::dropIfExists('likables');
    }
}
