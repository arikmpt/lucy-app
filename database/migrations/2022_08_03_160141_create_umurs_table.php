<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('umurs')) {
            Schema::create('umurs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('start_range')->nullable();
                $table->unsignedBigInteger('end_range')->nullable();
                $table->unsignedBigInteger('predict_value')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umurs');
    }
}
