<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_womens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });

        DB::table('custom_womens')->insert([
            ['name' => 'Bella + Canvas 6004',   'image' => 'img/BC6004.jpg'],
            ['name' => 'Bella + Canvas B8703',  'image' => 'img/BCB8703.jpg'],
            ['name' => 'Bella + Canvas B6035',  'image' => 'img/BCB6035.jpg'],
            ['name' => 'Bella + Canvas B1003',  'image' => 'img/BCB1003.jpg'],
            ['name' => 'Bella + Canvas B2000',  'image' => 'img/BCB2000.jpg'],
            ['name' => 'Bella + Canvas 6425',   'image' => 'img/BC6425.jpg'],
            ['name' => 'Bella + Canvas B6500',  'image' => 'img/BCB6500.jpg'],
            ['name' => 'Harriton M265W',        'image' => 'img/HM265W.jpg'],
            ['name' => 'Next Level 6610',       'image' => 'img/NL6610.jpg'],
            ['name' => 'Next Level N1540',      'image' => 'img/NLN1540.jpg'],
            ['name' => 'Next Level 6640',       'image' => 'img/NL6640.jpg']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_womens');
    }
}
