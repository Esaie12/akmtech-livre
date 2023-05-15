<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrousels', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('idAdmin');
            $table->boolean('visible')->default(true);
            $table->string('image');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_add');
            $table->date('date_expiration')->nullable();
            $table->date('date_desactive')->nullable();

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
        Schema::dropIfExists('carrousels');
    }
}
