<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteFeed extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['text', 'link', 'active', 'expire'];
    protected $fillable = ['text', 'link', 'active', 'expire'];
    protected $dates = ['expire'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
