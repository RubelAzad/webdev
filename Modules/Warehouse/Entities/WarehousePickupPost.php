<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehousePickupPost extends Model
{
    protected $fillable = ['post_id'];

    public function warehouse_pickup(){
        return $this->belongsTo('Modules\Warehouse\Entities\WarehousePickup', 'warehouse_pickup_id');
    }

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }
}
