<?php

namespace Modules\Agent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentAccount extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [];
    protected static $logAttributes = ['agent_id', 'date', 'amount', 'post_id', 'description', 'payment_method', 'payment_reference', 'user_id'];

    protected $dates = ['deleted_at', 'date'];

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }
}
