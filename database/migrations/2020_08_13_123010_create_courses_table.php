<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_eng')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('promo')->nullable();
            $table->string('starting_date');
            $table->string('fee');
            $table->text('overview')->nullable();
            $table->text('short_description')->nullable();
            $table->string('banner')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('status')->nullable()->default(1);
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
        Schema::dropIfExists('courses');
    }
}
