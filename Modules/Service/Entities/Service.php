<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logAttributes = ['provider_id', 'name', 'description', 'item_type', 'base_price', 'price', 'src_country', 'dst_country', 'minimum_weight', 'maximum_weight', 'commission', 'speed', 'active'];
    protected $fillable = ['provider_id', 'name', 'description', 'item_type', 'base_price', 'price', 'src_country', 'dst_country', 'minimum_weight', 'maximum_weight', 'commission', 'speed', 'active'];

    //protected static $logAttributes = ['provider_id', 'name', 'description', 'item_type', 'base_price', 'price', 'src_country', 'dst_country', 'minimum_weight', 'maximum_weight', 'speed', 'active'];
    //protected $fillable = ['provider_id', 'name', 'description', 'item_type', 'base_price', 'price', 'src_country', 'dst_country', 'minimum_weight', 'maximum_weight', 'speed', 'active'];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function provider(){
        return $this->belongsTo('Modules\Service\Entities\ServiceProvider', 'provider_id');
    }

    public function type(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPackageType', 'item_type');
    }
}
