<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('rotation');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('bgPictureUrl')->nullable();
            $table->text('observations')->nullable();
            $table->boolean('noPenalties')->nullable();
            $table->boolean('approved')->default(false);
            $table->string('contact')->nullable();
            $table->boolean('parent')->default(false);
            $table->unsignedInteger('parentId')->nullable();
            $table->foreign('parentId')->references('id')->on('companies');
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
        Schema::dropIfExists('companies');
    }
}
