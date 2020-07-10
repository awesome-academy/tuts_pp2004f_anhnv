<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 60)->nullable();
            $table->string('last_name', 60)->nullable();
            $table->string('image_avatar')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address_line_1', 100)->nullable();
            $table->string('address_line_2', 100)->nullable();
            $table->string('city')->nullable();
            $table->string('country', 100)->nullable();
            $table->integer('person_id');
            $table->string('person_type', 60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
