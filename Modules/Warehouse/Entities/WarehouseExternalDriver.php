<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehouseExternalDriver extends Model
{
    protected $fillable = [];

    public function warehouse(){
        return $this->belongsTo('Modules\Warehouse\Entities\Warehouse', 'warehouse_id');
    }
}
