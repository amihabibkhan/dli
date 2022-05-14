<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->mediumText('designation');
            $table->text('about');
            $table->string('profile_pic')->nullable();
            $table->string('square_image')->nullable();
            $table->mediumText('fb')->nullable();
            $table->mediumText('twitter')->nullable();
            $table->mediumText('freepik')->nullable();
            $table->mediumText('website')->nullable();
            $table->mediumText('instagram')->nullable();
            $table->mediumText('github')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
