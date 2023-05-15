<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('idUser');
            $table->bigInteger('idCategorie');

            $table->string('titre_pub');
            $table->string('auteur_pub');
            $table->string('description_pub')->nullable();
            $table->string('lien_pub');
            $table->string('photo_pub')->default("okkk.png");

            $table->date('date_pub');

            $table->boolean('by_admin')->default(true);

            $table->bigInteger('count_view')->default(0);
            $table->boolean('visible_pub')->default(true);

            //Pour les user
            $table->boolean('with_plan')->nullable();
            $table->bigInteger('type_plan')->nullable();
            $table->string('id_transaction')->nullable();
            $table->date('date_paiement')->nullable();
            $table->boolean('etat_paiement')->nullable();
            $table->bigInteger('etat_demande')->default(0);
            $table->string('raison_rejet')->nullable();

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
        Schema::dropIfExists('publications');
    }
}
