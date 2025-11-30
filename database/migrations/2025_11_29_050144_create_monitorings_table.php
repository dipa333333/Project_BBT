<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensor_id')->constrained('sensors')->onDelete('cascade');
            $table->float('value'); // nilai sensor
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
