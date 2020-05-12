<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPostPackage extends Model
{
    use LogsActivity;

    protected static $logAttributes = [
        'package_type_id',
        'quantity',
        'weight',
        'length',
        'width',
        'height',
        'post_id'
    ];
    protected $fillable = [
        'package_type_id',
        'quantity',
        'weight',
        'length',
        'width',
        'height',
        'post_id'
    ];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }

    public function type(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPackageType', 'package_type_id');
    }
}
