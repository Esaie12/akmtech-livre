<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('invite')->default(false);
            $table->integer('invite_by')->nullable();
            $table->string('name');

            $table->string('prenoms');
            $table->integer('solde')->default(0);
            $table->string('code_invitation')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->date('birthday')->nullable();
            $table->string('adresse')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('sexe')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
