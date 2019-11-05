<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestmodulesTable extends Migration
{
    public function up()
    {
        Schema::create('testmodules', function (Blueprint $table) {
            $table->increments('id');

            $table->string('textx')->unique();

            $table->string('emailx');

            $table->longText('textareack')->nullable();

            $table->longText('tetareanock')->nullable();

            $table->string('passwordx')->nullable();

            $table->string('radiox')->nullable();

            $table->string('selectx')->nullable();

            $table->boolean('checkboxx')->default(0)->nullable();

            $table->integer('integerx')->nullable();

            $table->float('floatx', 15, 2)->nullable();

            $table->decimal('moneyx', 15, 2)->nullable();

            $table->date('datepickerx')->nullable();

            $table->datetime('datetimepickerx')->nullable();

            $table->time('timepickerx')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
