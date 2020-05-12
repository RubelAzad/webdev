<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Zone extends Model
{
    use LogsActivity;
    protected $fillable = ['name', 'country_code', 'receive', 'pickup', 'collection', 'delivery'];
    protected static $logAttributes = ['name', 'country_code', 'receive', 'pickup', 'collection', 'delivery'];

    public function country(){
        return $this->belongsTo('Modules\Location\Entities\Country', 'country_code', 'iso_3166_3');
    }

    public function agents(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'zone_id');
    }


}
