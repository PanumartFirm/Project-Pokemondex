<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('poke_name', 60);
            $table->string('poke_content', 300);
            $table->string('poke_pic')->default('pokemon.jpg');
            $table->integer('spe_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('stype_id')->nullable()->unsigned();
            $table->integer('abi_id')->unsigned();
            $table->integer('hid_id')->unsigned();
            $table->string('gender', 30);
            $table->float('height');
            $table->float('weight');
            $table->timestamps();

            $table->foreign('spe_id')->references('id')->on('species');
            $table->foreign('type_id')->references('id')->on('type');
            $table->foreign('stype_id')->references('id')->on('subtype');
            $table->foreign('abi_id')->references('id')->on('abilities');
            $table->foreign('hid_id')->references('id')->on('hidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon');
    }
}
