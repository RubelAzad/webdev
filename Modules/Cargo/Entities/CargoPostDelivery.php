<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPostDelivery extends Model
{

    use LogsActivity;

    protected static $logAttributes = [
        'address',
        'receiver',
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'postcode',
        'county',
        'country',
        'note',
        'contact_person',
        'phone_number',
        'email',
        'instruction',
        'price',
        'post_id'
    ];
    protected $fillable = [
        'address',
        'receiver',
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'postcode',
        'county',
        'country',
        'note',
        'contact_person',
        'phone_number',
        'email',
        'instruction',
        'price',
        'post_id'
    ];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }
}
