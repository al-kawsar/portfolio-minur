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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->text('bio')->nullable(false);
            $table->date('tanggal_lahir', 100)->nullable(false);
            $table->string('alamat', 100)->nullable(false);
            $table->string('email', 100)->nullable(false)->unique();
            $table->string('nomor_hp', 100)->nullable(false)->unique();
            $table->string('gambar', 255)->nullable(true);
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
        Schema::dropIfExists('profiles');
    }
};
