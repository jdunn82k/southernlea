<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('product_info');
            $table->decimal('shipping_cost', 8,2);
            $table->decimal('subtotal', 8,2);
            $table->decimal('tax_rate', 8,2);
            $table->decimal('grand_total', 8,2);
            $table->integer('total_items_sold');
            $table->string('payment_method')->default('Paypal');
            $table->boolean('payment_successful')->default(false);
            $table->boolean('order_shipped')->default(false);
            $table->string('tracking_number')->nullable();
            $table->string('method')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
