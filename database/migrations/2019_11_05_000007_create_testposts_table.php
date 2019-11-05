<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestpostsTable extends Migration
{
    public function up()
    {
        Schema::create('testposts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();

            $table->string('slug')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
