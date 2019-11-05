<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestpostXcategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('testpost_xcategory', function (Blueprint $table) {
            $table->unsignedInteger('testpost_id');

            $table->foreign('testpost_id', 'testpost_id_fk_565245')->references('id')->on('testposts')->onDelete('cascade');

            $table->unsignedInteger('xcategory_id');

            $table->foreign('xcategory_id', 'xcategory_id_fk_565245')->references('id')->on('xcategories')->onDelete('cascade');
        });
    }
}
