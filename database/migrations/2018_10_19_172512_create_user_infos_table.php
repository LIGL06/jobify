<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->index()->unsigned();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->string('fName');
            $table->string('lName');
            $table->date('doB');
            $table->enum('civilStatus', ['casado', 'soltero', 'otro']);
            $table->string('phone');
            $table->string('address');
            $table->boolean('professional');
            $table->string('profession')->nullable();
            $table->boolean('handyCap');
            $table->string('uniqueKey')->unique()->nullable();
            $table->string('socialKey')->unique()->nullable();
            $table->decimal('salary', 6, 2);
            $table->string('pictureUrl')->nullable();
            $table->string('cvUrl')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
