<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Patients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->string('name', 80);
            $table->char('gender', 1)->nullable();
            $table->date('birthday')->nullable();
            $table->string('document', 14);
            $table->string('profession', 60)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('indication', 60)->nullable();
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
        Schema::dropIfExists('patients');
    }
}
