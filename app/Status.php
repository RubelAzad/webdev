<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'public', 'active'];
    protected $fillable = ['name', 'public', 'active'];

    //protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

}
