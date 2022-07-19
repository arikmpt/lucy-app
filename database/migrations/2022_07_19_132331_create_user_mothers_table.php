<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMothersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_mothers')) {
            Schema::create('user_mothers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('job')->nullable();
                $table->text('address')->nullable();
                $table->timestamps();

                if (Schema::hasTable('users')) {
                    $table->unsignedBigInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users');
                }
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
        Schema::dropIfExists('user_mothers');
    }
}
