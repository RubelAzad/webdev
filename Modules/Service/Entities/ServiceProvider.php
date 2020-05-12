<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceProvider extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logAttributes = ['name', 'description', 'active'];
    protected $fillable = ['name', 'description', 'active'];

    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function services(){
        return $this->hasMany('Modules\Service\Entities\Service', 'provider_id');
    }
}
