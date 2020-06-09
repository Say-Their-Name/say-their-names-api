<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaLinksTable extends Migration
{
    public function up()
    {
        Schema::create('media_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->longText('url');
            $table->foreign('person_id')->references('id')->on('people');
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}
