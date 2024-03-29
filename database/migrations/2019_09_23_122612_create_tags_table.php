<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tag_video', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->on('tags')->references('id')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->on('videos')->references('id')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('tags');
    }
}
