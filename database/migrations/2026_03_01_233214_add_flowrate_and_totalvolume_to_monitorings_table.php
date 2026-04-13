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
        Schema::table('monitorings', function (Blueprint $table) {
            $table->float('flow_rate')->nullable()->after('value');
            $table->float('total_volume')->nullable()->after('flow_rate');
        });
    }

    public function down()
    {
        Schema::table('monitorings', function (Blueprint $table) {
            $table->dropColumn(['flow_rate', 'total_volume']);
        });
    }
};
