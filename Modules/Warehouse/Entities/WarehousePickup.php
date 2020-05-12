<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehousePickup extends Model
{
    protected $fillable = [];


    protected $dates = ['date', 'est_pickup_date'];

    public function scopeNot_picked($query){
        return $query->where('local_status', 0)->orWhere('local_status', null);
    }

    public function scopePicked($query){
        return $query->where('local_status', 1);
    }

    public function warehouse(){
        return $this->belongsTo('Modules\Warehouse\Entities\Warehouse', 'warehouse_id');
    }

    public function posts(){
        return $this->hasMany('Modules\Warehouse\Entities\WarehousePickupPost', 'warehouse_pickup_id');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function ext_driver(){
        return $this->belongsTo('Modules\Warehouse\Entities\WarehouseExternalDriver', 'external_driver_id');
    }

    public function driver(){
        return $this->belongsTo('App\User', 'driver_id');
    }
}
