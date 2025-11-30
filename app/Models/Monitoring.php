<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = ['sensor_id', 'value'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
