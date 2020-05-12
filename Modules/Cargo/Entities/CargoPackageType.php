<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPackageType extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'code', 'active'];
    protected $fillable = ['name', 'code', 'active'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }


}
