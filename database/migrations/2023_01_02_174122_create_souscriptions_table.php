<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();

            $table->boolean('active')->default(true);
            $table->bigInteger('idUser');
            $table->string('description');
            $table->string('idTransaction')->nullable();
            $table->bigInteger('idPack');
            $table->date('dateStart');
            $table->date('dateEnd')->nullable();

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
        Schema::dropIfExists('souscriptions');
    }
}
