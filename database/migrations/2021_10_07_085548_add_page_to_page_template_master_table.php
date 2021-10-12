<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageToPageTemplateMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_template_master', function (Blueprint $table) {
            //
            $table->string('page_name');
            $table->string('page_title');
            $table->text('page_logo');
            $table->longText('page_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_template_master', function (Blueprint $table) {
            //
            $table->dropColumn('page_name');
            $table->dropColumn('page_title');
            $table->dropColumn('page_logo');
            $table->dropColumn('page_desc');

        });
    }
}
