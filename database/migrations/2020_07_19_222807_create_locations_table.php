<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location_name', 50)->unique();
            $table->string('email', 256)->unique();
            $table->string('phone', 11)->unique();
            $table->string('address', 50);
            $table->unsignedInteger('major_classification_id')->nullable();
            $table->unsignedInteger('middle_classification_id')->nullable();
            $table->unsignedInteger('small_classification_id')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('prefecture_id');
            $table->unsignedInteger('city_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('locations');
    }
}
