<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Town extends Model
{

    use LogsActivity;
    protected $fillable = ['name', 'city_id'];
    protected static $logAttributes = ['name', 'city_id'];

    public function city(){
        return $this->belongsTo('Modules\Location\Entities\City');
    }
}
