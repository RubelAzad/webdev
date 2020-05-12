<?php

namespace Modules\Agent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentEmployee extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logAttributes = [
        'type_id',
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country',
        'phone_number',
        'email',
        'note',
        'active',
        'agent_id',
        'user_id',
        'role_id'
    ];
    protected $fillable = [
        'type_id',
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'county',
        'postcode',
        'country',
        'phone_number',
        'email',
        'note',
        'active',
        'agent_id',
        'user_id',
        'role_id'
    ];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }


    public function type(){
        return $this->belongsTo('App\EmployeeDesignation', 'type_id');
    }

    public function role(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function user(){
        $this->belongsTo('App\User', 'user_id');
    }
}
