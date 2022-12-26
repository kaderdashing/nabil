<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiopsiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biopsies', function (Blueprint $table) {
            $table->id();
            $table->enum('choices', ['X']);
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('type')->nullable();
            $table->string('num')->nullable();
            $table->string('serie')->unique();
            $table->integer('paye')->default(0);
            $table->integer('reste')->default(0);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('biopsies');
    }
}
