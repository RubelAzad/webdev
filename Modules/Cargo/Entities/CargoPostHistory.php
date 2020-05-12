<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class CargoPostHistory extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['post_id', 'description', 'user_id'];
    protected $fillable = ['post_id', 'description', 'user_id'];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }
}
