<?php

namespace Modules\Enquiry\Entities;

use Illuminate\Database\Eloquent\Model;

class EnquiryAgent extends Model
{
    protected $fillable = [];

    public function subject(){
        return $this->belongsTo('Modules\Enquiry\Entities\EnquirySubject', 'subject_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function status(){
        return $this->belongsTo('Modules\Enquiry\Entities\EnquiryStatus', 'status_id');
    }
}
