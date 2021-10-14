<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTemplateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_template_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content');
            $table->string('page_name');
            $table->string('page_title');
            $table->text('page_logo');
            $table->longText('page_desc');
            $table->string('owner');
            $table->integer('created_by');
            $table->integer('deleted');
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
        Schema::dropIfExists('page_template_user');
    }
}
