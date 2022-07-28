<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('predicts')) {
            Schema::create('predicts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('nim')->nullable();
                $table->string('phone')->nullable()->unique();
                $table->string('email')->unique();
                $table->date('date_of_birth')->nullable();
                $table->string('place_of_birth')->nullable();
                $table->enum('gender', ['L', 'P']);
                $table->string('major')->nullable();
                $table->string('school')->nullable();
                $table->string('school_major')->nullable();
                $table->string('school_cluster')->nullable();
                $table->enum('status', ['DAFTAR','TIDAK']);
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
        Schema::dropIfExists('predicts');
    }
}
