<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoSender extends Model
{
    use LogsActivity;

    protected static $logAttributes = [
        'user_id',
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
        'email'
    ];
    protected $fillable = [
        'user_id',
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
        'agent_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function receivers(){
        return $this->hasMany('Modules\Cargo\Entities\CargoReceiver', 'sender_id');
    }
}
