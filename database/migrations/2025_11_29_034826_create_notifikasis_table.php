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
    Schema::create('notifikasis', function (Blueprint $table) {
        $table->id();
        $table->string('tipe'); // kebocoran, offline, overloaded
        $table->string('pesan');
        $table->enum('status', ['baru', 'dibaca'])->default('baru');
        $table->timestamps();
    });
}

};
