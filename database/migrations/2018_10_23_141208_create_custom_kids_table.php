<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_kids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('custom_kids')->insert([
           ['name' => 'Bella + Canvas 3001Y', 'image' => 'img/BC3001Y.jpg'],
           ['name' => 'Bella + Canvas 3413Y', 'image' => 'img/BC3414Y.jpg'],
           ['name' => 'Bella + Canvas B9001', 'image' => 'img/BCB9001.jpg'],
           ['name' => 'Bella + Canvas 3501Y', 'image' => 'img/BC3501Y.jpg'],
           ['name' => 'Bella + Canvas 3200Y', 'image' => 'img/BC3200Y.jpg']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_kids');
    }
}
