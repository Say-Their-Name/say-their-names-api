<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationLinksTable extends Migration
{
    public function up()
    {
        Schema::create('donation_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('identifier');
            $table->string('banner_img_url')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('outcome')->nullable();
            $table->string('outcome_img_url')->nullable();
            $table->longText('link');
            $table->json('sharable_links')->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
