<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPost extends Model
{
    use LogsActivity, SoftDeletes, Notifiable;

    protected static $logAttributes = [
        'tracking_no',
        'sender_id',
        'sender_details',
        'receiver_id',
        'receiver_details',
        'description',
        'value',
        'service_id',
        'unit_price',
        'service_details',
        'insurance',
        'insurance_all',
        'insurance_price',
        'packaging',
        'packaging_price',
        'note',
        'agent_id',
        'user_id',
        'active'
    ];
    protected $fillable = [
        'tracking_no',
        'sender_id',
        'sender_details',
        'receiver_id',
        'receiver_details',
        'description',
        'value',
        'service_id',
        'unit_price',
        'service_details',
        'insurance',
        'insurance_all',
        'insurance_price',
        'packaging',
        'packaging_price',
        'note',
        'agent_id',
        'user_id',
        'active'
    ];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeCurrent($query){
        return $query->whereBetween('status_id', [1,7]);
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function sender(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoSender', 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoReceiver', 'receiver_id');
    }

    public function service(){
        return $this->belongsTo('Modules\Service\Entities\Service', 'service_id');
    }

    public function items(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPostItem', 'post_id');
    }

    public function packages(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPostPackage', 'post_id');
    }

    public function delivery(){
        return $this->hasOne('Modules\Cargo\Entities\CargoPostDelivery', 'post_id');
    }

    public function insurances(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPostInsurance', 'post_id');
    }

    public function histories(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPostHistory', 'post_id');
    }

    public function statuses(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPostStatus', 'post_id');
    }

    public function current_status(){
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function pickup_request(){
        return $this->hasOne('Modules\Cargo\Entities\CargoPickup', 'cargo_post_id');
    }

    public function billing(){
        return $this->hasOne('Modules\Cargo\Entities\CargoBilling', 'post_id');
    }
}
