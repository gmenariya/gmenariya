<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXcategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('xcategories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('slug');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
