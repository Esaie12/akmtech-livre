<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser');
            $table->bigInteger('etat_demande')->default(0);

            //montant_retirer":null,"receve_moyen":null,"numero_adresse":null,"info_receve"
            $table->bigInteger('solde_moment');

            $table->bigInteger('montant_retirer');
            $table->string('receve_moyen');
            $table->string('numero_adresse');
            $table->string('info_receve');
            $table->date('date_demande');

            //Pour l'admin
            $table->bigInteger('etude_by_idAdmin')->nullable();
            $table->string('raison_rejet')->nullable();
            $table->string('preuve_envoie')->nullable();
            $table->date('date_reponse')->nullable();


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
        Schema::dropIfExists('operations');
    }
}
