<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;

class CargoPostStatus extends Model
{
    protected $fillable = ['post_id', 'status_id'];

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'post_id');
    }

    public function detail(){
        return $this->belongsTo('App\Status', 'status_id');
    }
}
