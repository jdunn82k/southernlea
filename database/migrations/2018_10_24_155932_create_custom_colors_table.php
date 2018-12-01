<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hex');
            $table->timestamps();
        });

        DB::table('custom_colors')->insert([
                ['name' => '#0aa5e2', 'hex' => '#0aa5e2'],
                ['name' => '#40e0d0', 'hex' => '#40e0d0'],
                ['name' => '#b03060', 'hex' => '#b03060'],
                ['name' => '#000080', 'hex' => '#000080'],
                ['name' => '#e60d41', 'hex' => '#e60d41'],
                ['name' => '#45bf55', 'hex' => '#45bf55'],
                ['name' => '#ff7f00', 'hex' => '#ff7f00'],
                ['name' => '#8b4513', 'hex' => '#8b4513'],
                ['name' => '#ffd700', 'hex' => '#ffd700'],
                ['name' => '#9fa8ab', 'hex' => '#9fa8ab'],
                ['name' => '#0aa5e2', 'hex' => '#0aa5e2'],
                ['name' => '#ffcbdb', 'hex' => '#ffcbdb'],
                ['name' => '#b87333', 'hex' => '#b87333'],
                ['name' => '#bfb540', 'hex' => '#bfb540'],
                ['name' => '#e60d41', 'hex' => '#e60d41'],
                ['name' => '#45bf55', 'hex' => '#45bf55'],
                ['name' => '#ff7f00', 'hex' => '#ff7f00'],
                ['name' => '#8b4513', 'hex' => '#8b4513'],
                ['name' => '#ffd700', 'hex' => '#ffd700'],
                ['name' => '#9fa8ab', 'hex' => '#9fa8ab']
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_colors');
    }
}
