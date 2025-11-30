<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 // Pastikan Anda mengimpor Model Monitoring jika berada di namespace yang berbeda

class Sensor extends Model
{
    protected $fillable = [
        'nama_sensor',
        'lokasi',
        'tipe',
        'status'
    ];

    /**
     * Get all of the monitoring data for the Sensor
     */
    public function monitoring()
    {
        return $this->hasMany(Monitoring::class);
    }
}
