<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * $noti->idUser_from = Auth::user()->invite_by;

     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifs', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser_from');
            $table->string('message');
            $table->date('date_receve');
            $table->boolean('vue_from')->default(false);
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
        Schema::dropIfExists('notifs');
    }
}
