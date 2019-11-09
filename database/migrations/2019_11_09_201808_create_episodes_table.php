<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episodes', function (Blueprint $table) {
            Schema::create('episodes', function (Blueprint $table) {
                $table->bigInteger('show_id')->unsigned();
                $table->integer('ep_id');
                $table->string('title');
                $table->string('description');
                $table->enum('show_day', [1,2,3,4,5,6,7]);
                $table->time('show_time');
                $table->string('thumbnail');
                $table->string('video_content');
                $table->foreign('show_id')->references('id')->on('shows');
                $table->timestamps();
                $table->primary(['ep_id', 'show_id']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
