<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;

class CargoPickup extends Model
{
    protected $fillable = [];

    public function scopeNot_picked($query){
        return $query->where('picked', 0);
    }

    public function scopePicked($query){
        return $query->where('picked', 1);
    }

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function post(){
        return $this->belongsTo('Modules\Cargo\Entities\CargoPost', 'cargo_post_id');
    }
}
