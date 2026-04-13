<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = ['sensor_id', 'value', 'flow_rate', 'total_volume'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
