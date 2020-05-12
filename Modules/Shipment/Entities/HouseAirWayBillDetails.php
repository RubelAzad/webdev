<?php

namespace Modules\Shipment\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HouseAirWayBillDetails extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['hawb_id', 'post_id'];
    protected $fillable = ['hawb_id', 'post_id'];

    public function hawb(){
        return $this->belongsTo('Modules\Shipment\Entities\HouseAirWayBill', 'hawb_id');
    }

    public function actual_post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }

}
