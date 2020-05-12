<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{

    use LogsActivity;
    protected $fillable = ['name', 'country_id'];
    protected static $logAttributes = ['name', 'country_id'];

    public function country(){
        return $this->belongsTo('Modules\Location\Entities\Country');
    }

    public function towns(){
        return $this->hasMany('Modules\Location\Entities\Town');
    }
}
