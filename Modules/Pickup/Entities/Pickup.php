<?php

namespace Modules\Pickup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Pickup extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Notifiable;

    protected static $logAttributes = [
        'name',
        'agent_id',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country_code',
        'phone_number',
        'email',
        'note',
        'quantity',
        'weight',
        'description',
        'preferred_date',
        'preferred_time',
        'active'
    ];
    protected $fillable = [
        'name',
        'agent_id',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country_code',
        'phone_number',
        'email',
        'note',
        'quantity',
        'weight',
        'description',
        'preferred_date',
        'preferred_time',
        'active'
    ];

    protected $dates = ['deleted_at', 'preferred_date'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeArchive($query){
        return $query->where('active', 0);
    }

    public function country(){
        return $this->belongsTo('Modules\Location\Entities\Country', 'country_code', 'iso_3166_3');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }


}
