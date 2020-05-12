<?php

namespace Modules\Franchise\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Franchise extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected static $logAttributes = [
        'name',
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
        'ch_number',
        'vat_number',
        'logo_id',
        'active',
        'completed',
        'approved',
        'approved_by',
        'created_by'
    ];
    protected $fillable = [
        'name',
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
        'ch_number',
        'vat_number',
        'logo_id',
        'active',
        'completed',
        'approved',
        'approved_by',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function logo(){
        return $this->belongsTo('App\File', 'logo_id');
    }

    public function documents(){
        return $this->hasMany('Modules\Franchise\Entities\FranchiseDocument', 'franchise_id');
    }

    public function employees(){
        return $this->hasMany('Modules\Franchise\Entities\FranchiseEmployee', 'franchise_id');
    }

    public function agents(){
        return $this->hasMany('Modules\Agent\Entities\Agent', 'franchise_id');
    }
}
