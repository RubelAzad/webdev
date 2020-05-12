<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;

class CargoPostInsurance extends Model
{
    protected $fillable = ['post_id', 'item_id', 'name', 'value', 'cost', 'com_franchise', 'com_agent'];
}
