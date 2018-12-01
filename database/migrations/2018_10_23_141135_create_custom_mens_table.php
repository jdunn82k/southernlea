<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomMensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_mens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('custom_mens')->insert([
            ['name' => 'Bella + Canvas 3091',   'image' => 'img/BC3091.jpg'],
            ['name' => 'Bella + Canvas 3001U',  'image' => 'img/BC3001U.jpg'],
            ['name' => 'Bella + Canvas B3014',  'image' => 'img/BCB3014.jpg'],
            ['name' => 'Bella + Canvas 3021',   'image' => 'img/BC3021.jpg'],
            ['name' => 'Bella + Canvas 3402',   'image' => 'img/BC3402.jpg'],
            ['name' => 'Bella + Canvas 3425',   'image' => 'img/BC3425.jpg']

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_mens');
    }
}
