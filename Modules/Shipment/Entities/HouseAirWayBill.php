<?php

namespace Modules\Shipment\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HouseAirWayBill extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['mawb_id', 'max_weight', 'status_id', 'created_by', 'edited_by'];
    protected $fillable = ['mawb_id', 'max_weight', 'status_id', 'created_by', 'edited_by'];

    public function creator(){
        return $this->belongsTo('App\User', 'created_by');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'edited_by');
    }

    public function posts(){
        return $this->hasMany('Modules\Shipment\Entities\HouseAirWayBillDetails', 'hawb_id');
    }


}
