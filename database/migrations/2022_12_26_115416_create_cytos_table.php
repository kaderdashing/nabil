<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCytosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cytos', function (Blueprint $table) {
            $table->id();
            $table->enum('choices', ['Y']);
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('type')->nullable();
            $table->string('num')->nullable();
            $table->string('serie')->unique();
            $table->integer('paye')->default(0);
            $table->integer('reste')->default(0);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('cytos');
    }
}
