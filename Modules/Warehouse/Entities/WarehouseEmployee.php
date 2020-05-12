<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehouseEmployee extends Model
{
    protected $fillable = [];

    public function warehouse(){
        return $this->belongsTo('Modules\Warehouse\Entities\Warehouse');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }
}
