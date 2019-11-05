<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTestmodulePivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_testmodule', function (Blueprint $table) {
            $table->unsignedInteger('testmodule_id');

            $table->foreign('testmodule_id', 'testmodule_id_fk_565298')->references('id')->on('testmodules')->onDelete('cascade');

            $table->unsignedInteger('category_id');

            $table->foreign('category_id', 'category_id_fk_565298')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
