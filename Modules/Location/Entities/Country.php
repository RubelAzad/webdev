<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * CountryList
 *
 */
class Country extends Model {

    use LogsActivity;
    protected $fillable = [
        'capital',
        'citizenship',
        'country_code',
        'currency',
        'currency_code',
        'currency_sub_unit',
        'currency_symbol',
        'currency_decimals',
        'full_name',
        'iso_3166_2',
        'iso_3166_3',
        'name',
        'region_code',
        'sub_region_code',
        'eea',
        'calling_code',
        'flag'
    ];
    protected static $logAttributes = [
        'capital',
        'citizenship',
        'country_code',
        'currency',
        'currency_code',
        'currency_sub_unit',
        'currency_symbol',
        'currency_decimals',
        'full_name',
        'iso_3166_2',
        'iso_3166_3',
        'name',
        'region_code',
        'sub_region_code',
        'eea',
        'calling_code',
        'flag'
    ];

    public function cities(){
        return $this->hasMany('Modules\Location\Entities\City');
    }

    public function towns(){
        return $this->hasManyThrough('Modules\Location\Entities\Town', 'Modules\Location\Entities\City');
    }

    public function franchises(){
        return $this->hasMany('Modules\Franchise\Entities\Franchise', 'country', 'iso_3166_3');
    }

    public function agents(){
        return $this->hasMany('Modules\Agent\Entities\Agent', 'country', 'iso_3166_3');
    }

    public function zones(){
        return $this->hasMany('Modules\Location\Entities\Zone', 'country_code', 'iso_3166_3');
    }

    public function vats(){
        return $this->hasMany('Modules\Location\Entities\CountryVat', 'country_id');
    }

}
