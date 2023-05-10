<?php

namespace App\Traits;

trait DriverAttributeTrait
{

    public function getIsTaxiDriverAttribute()
    {
        if ($this->role_name == "driver") {
            $driverType = $this->driver_type;
            if (empty($driverType)) {
                return !empty($this->vehicle());
            } else {
                return $driverType->is_taxi ?? false;
            }
        }


        return false;
    }


    //
    public function driver_type()
    {
        return $this->hasOne('App\Models\DriverType', 'driver_id', 'id');
    }
}
