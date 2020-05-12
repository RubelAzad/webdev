<?php

namespace Modules\Agent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentPayment extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [];
    protected static $logAttributes = ['agent_id', 'date', 'amount', 'description', 'payment_method', 'payment_reference', 'user_id'];

    protected $dates = ['deleted_at', 'date'];

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

}
