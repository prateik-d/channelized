<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatePageMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_page_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('content');
            $table->string('owner');
            $table->integer('created_by');
            $table->integer('deleted');
            $table->text('filepath');
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
        Schema::dropIfExists('template_page_master');
    }
}
