<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoorraadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voorraad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('naam');
            $table->text('omschrijving');
            $table->integer('aantal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voorraad');
    }
}
