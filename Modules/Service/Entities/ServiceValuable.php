<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceValuable extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['name', 'src_country', 'dst_country', 'purchase_price', 'price', 'max_price', 'commission', 'active', 'service_id'];
    protected $fillable = ['name', 'src_country', 'dst_country', 'purchase_price', 'price', 'max_price', 'commission', 'active', 'service_id'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
