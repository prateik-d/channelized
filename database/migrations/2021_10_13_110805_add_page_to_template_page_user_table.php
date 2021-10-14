<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageToTemplatePageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_template_user', function (Blueprint $table) 
        {
            //
            $table->string('page_sub_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_template_user', function (Blueprint $table) 
        {
            //
            $table->dropColumn('page_sub_title');
        });
    }
}
