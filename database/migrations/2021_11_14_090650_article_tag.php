<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticleTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('article_tag', function (Blueprint $table) {
        $table->unsignedBigInteger('article_id')->unsigned()->nullable();
        $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        $table->unsignedBigInteger('tag_id')->unsigned()->nullable();
        $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
    }
}
