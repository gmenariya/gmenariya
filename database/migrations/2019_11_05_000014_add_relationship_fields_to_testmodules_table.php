<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTestmodulesTable extends Migration
{
    public function up()
    {
        Schema::table('testmodules', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable();

            $table->foreign('category_id', 'category_fk_565297')->references('id')->on('xcategories');
        });
    }
}
