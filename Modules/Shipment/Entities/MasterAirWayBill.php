<?php

namespace Modules\Shipment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class MasterAirWayBill extends Model
{
    use LogsActivity;
    use SoftDeletes;
    protected static $logAttributes = ['flight_no', 'flight_date', 'max_weight', 'created_by', 'edited_by'];
    protected $fillable = ['flight_no', 'flight_date', 'max_weight', 'created_by', 'edited_by'];

    protected $dates = ['deleted_at', 'flight_date'];

    public function creator(){
        return $this->belongsTo('App\User', 'created_by');
    }
    public function editor(){
        return $this->belongsTo('App\User', 'edited_by');
    }
}
