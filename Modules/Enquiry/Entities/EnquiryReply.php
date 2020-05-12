<?php

namespace Modules\Enquiry\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EnquiryReply extends Model
{
    use LogsActivity;

    protected $fillable = ['user_id', 'enquiry_id', 'message'];
    protected static $logAttributes = ['user_id', 'enquiry_id', 'message'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


}
