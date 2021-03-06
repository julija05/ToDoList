<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->longText('description');
            $table->smallInteger('status')->default(0);
            $table->timestamp('ended_at');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('to_do_list_id');


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('to_do_list_id')->references('id')->on('to_do_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
