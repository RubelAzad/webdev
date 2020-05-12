<?php

namespace Modules\Agent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Agent extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Notifiable;

    protected static $logAttributes = [
        'name',
        'franchise_id',
        'contact_person',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country',
        'phone_number',
        'ev_phone_number',
        'fax_number',
        'email',
        'note',
        'area',
        'commission',
        'increment',
        'commission_valuable',
        'ch_number',
        'vat_number',
        'logo_id',
        'active',
        'completed',
        'approved',
        'approved_by',
        'created_by',
        'zone_id',
        'receive',
        'pickup',
        'collection',
        'delivery',
        'allow_discount',
        'additional_charge',
        'holding_credit',
        'credit',
        'balance'
    ];
    protected $fillable = [
        'name',
        'franchise_id',
        'contact_person',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country',
        'phone_number',
        'ev_phone_number',
        'fax_number',
        'email',
        'note',
        'area',
        'commission',
        'increment',
        'commission_valuable',
        'ch_number',
        'vat_number',
        'logo_id',
        'active',
        'completed',
        'approved',
        'approved_by',
        'created_by',
        'zone_id',
        'receive',
        'pickup',
        'collection',
        'delivery',
        'allow_discount',
        'additional_charge',
        'credit',
        'holding_credit',
        'balance'
    ];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function logo(){
        return $this->belongsTo('App\File', 'logo_id');
    }

    public function main_country(){
        return $this->belongsTo('Modules\Location\Entities\Country', 'country', 'iso_3166_3');
    }

    public function zone(){
        return $this->belongsTo('Modules\Location\Entities\Zone', 'zone_id');
    }

    public function franchise(){
        return $this->belongsTo('Modules\Franchise\Entities\Franchise', 'franchise_id');
    }

    public function documents(){
        return $this->hasMany('Modules\Agent\Entities\AgentDocument', 'agent_id');
    }

    public function officers(){
        return $this->hasMany('Modules\Agent\Entities\AgentEmployee', 'agent_id');
    }

    public function drafts(){
        return $this->hasMany('Modules\Cargo\Entities\CargoDraft', 'agent_id');
    }

    public function posts(){
        return $this->hasMany('Modules\Cargo\Entities\CargoPost', 'agent_id');
    }

    public function enquiries(){
        return $this->belongsToMany('Modules\Enquiry\Entities\Enquiry')->withPivot('active')->withTimestamps();
    }

    public function accounts(){
        return $this->hasMany('Modules\Agent\Entities\AgentAccount', 'agent_id');
    }

    public function payments(){
        return $this->hasMany('Modules\Agent\Entities\AgentPayment', 'agent_id');
    }

    public function closing_balances(){
        return $this->hasMany('Modules\Agent\Entities\AgentAccountBalance', 'agent_id');
    }

    public function sent_enquiries(){
        return $this->hasMany('Modules\Enquiry\Entities\EnquiryAgent', 'agent_id');
    }
}
