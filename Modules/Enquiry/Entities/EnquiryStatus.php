<?php

namespace Modules\Enquiry\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EnquiryStatus extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'active'];
    protected $fillable = ['name', 'active'];

    //protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
