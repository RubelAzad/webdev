<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;

class CargoDraft extends Model
{

    protected $fillable = ['sender_id', 'receiver_id', 'packages', 'doc', 'service_id', 'optionals', 'note', 'agent_id', 'user_id'];

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
}
