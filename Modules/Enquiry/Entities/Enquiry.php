<?php

namespace Modules\Enquiry\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Enquiry extends Model
{

    use Notifiable, LogsActivity;

    protected $fillable = ['name', 'phone_number', 'email', 'subject', 'message', 'send_copy', 'read', 'link'];
    protected static $logAttributes = ['name', 'phone_number', 'email', 'subject', 'message', 'send_copy', 'read', 'link'];

    //protected $dates = ['deleted_at'];

    public function agents(){
        return $this->belongsToMany('Modules\Agent\Entities\Agent')->withPivot('id', 'active')->withTimestamps()->orderBy('pivot_id', 'desc');
    }

    public function replies(){
        return $this->hasMany('Modules\Enquiry\Entities\EnquiryReply');
    }


}
