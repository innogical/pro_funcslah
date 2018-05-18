<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('show_case', function (Blueprint $table) {
            $table->increments('show_case_id');
            $table->string('show_case_name');
            $table->string('show_case_creator');
            $table->string('show_case_img');
            $table->string('show_case_id_stu',8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('show_case');

    }
}
