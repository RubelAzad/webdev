<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class WarehouseEntry extends Model
{
    use LogsActivity, SoftDeletes;
    protected static $logAttributes = ['warehouse_id', 'post_id', 'date', 'release', 'entry_by', 'release_by', 'comment'];
    protected $fillable = ['warehouse_id', 'post_id', 'date', 'release', 'entry_by', 'release_by', 'comment'];

    protected $dates = ['deleted_at', 'date', 'release',];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }


}
