<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    protected $fillable = [];

    protected $dates = ['deleted_at'];

    public function employees(){
        return $this->hasMany('Modules\Warehouse\Entities\WarehouseEmployee');
    }

    public function external_drivers(){
        return $this->hasMany('Modules\Warehouse\Entities\WarehouseExternalDriver', 'warehouse_id');
    }

    public function entries(){
        return $this->hasMany('Modules\Warehouse\Entities\WarehouseEntry', 'warehouse_id');
    }
}
