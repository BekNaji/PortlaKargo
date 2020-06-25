<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('status');
            $table->string('total_price')->nullable();
            $table->string('total_kg')->nullable();
            $table->string('payment_type');
            $table->foreignId('sender_id');
            $table->foreignId('receiver_id');

            $table->foreign('sender_id')->references('id')->on('customers');
            $table->foreign('receiver_id')->references('id')->on('receivers');



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
        Schema::dropIfExists('cargos');
    }
}
