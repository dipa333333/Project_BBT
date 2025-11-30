<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sensor');
            $table->string('lokasi');
            $table->string('tipe')->default('Flowmeter');
            $table->enum('status', ['online', 'offline'])->default('online');
            $table->timestamps();
        });
    }

};
