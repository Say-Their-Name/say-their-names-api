<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('identifier');
            $table->date('date_of_incident');
            $table->string('number_of_children')->nullable();
            $table->string('age');
            $table->string('city');
            $table->string('country');
            $table->text('biography')->nullable();
            $table->text('context')->nullable();
            $table->text('outcome')->nullable();
            $table->json('sharable_links')->nullable();
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->integer('moderated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
