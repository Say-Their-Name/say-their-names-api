<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashTagsTable extends Migration
{
    public function up()
    {
        Schema::create('hash_tags', function (Blueprint $table) {
            $table->id();
            $table->morphs('taggable');
            $table->string('tag');
            $table->string('link');
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_media');
    }
}
