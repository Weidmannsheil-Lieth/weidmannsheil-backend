<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routs', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('year');

            $table->string('king');
            $table->string('first_knight')->nullable();
            $table->string('second_knight')->nullable();
            $table->string('youth_king')->nullable();
            $table->string('citizen_king')->nullable();
            $table->string('citizen_youth_king')->nullable();

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
        Schema::dropIfExists('routs');
    }
}
