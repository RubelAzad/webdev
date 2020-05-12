<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPostItem extends Model
{
    use LogsActivity;

    protected static $logAttributes = [
        'name',
        'value',
        'tax',
        'original_tax',
        'insurance',
        'insurance_price',
        'post_id'
    ];
    protected $fillable = [
        'name',
        'value',
        'tax',
        'original_tax',
        'insurance',
        'insurance_price',
        'post_id'
    ];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }
}
