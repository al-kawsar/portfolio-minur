<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('akun_instagram',100)->nullable();
            $table->string('akun_facebook',100)->nullable();
            $table->string('akun_twitter',100)->nullable();
            $table->string('akun_github',100)->nullable();
            $table->string('akun_youtube',100)->nullable();
            $table->string('akun_linkedin',100)->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
