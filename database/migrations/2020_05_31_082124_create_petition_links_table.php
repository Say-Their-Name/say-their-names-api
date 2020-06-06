<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionLinksTable extends Migration
{
    public function up()
    {
        Schema::create('petition_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('banner_img_url')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('outcome')->nullable();
            $table->string('outcome_img_url')->nullable();
            $table->string('link');
            $table->foreign('person_id')->references('id')->on('people');
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petitions');
    }
}
