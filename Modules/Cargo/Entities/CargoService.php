<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoService extends Model
{
    /*
     * deprecated, this model and related database table not in use
     */

    use LogsActivity, SoftDeletes;

    protected static $logAttributes = ['name', 'provider', 'active'];
    protected $fillable = ['name', 'provider', 'active'];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function items(){
        return $this->hasMany('Modules\Cargo\Entities\CargoServiceItem', 'service_id');
    }
}
