<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoServiceItem extends Model
{
    /*
     * deprecated, this model and related database table not in use
     */
    use LogsActivity, SoftDeletes;

    protected static $logAttributes = ['service_id', 'price', 'src_country', 'dst_country', 'minimum_weight', 'speed', 'active'];
    protected $fillable = ['service_id', 'price', 'src_country', 'dst_country', 'minimum_weight', 'speed', 'active'];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function service(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoService', 'service_id');
    }
}
