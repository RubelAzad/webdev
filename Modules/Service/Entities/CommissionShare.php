<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class CommissionShare extends Model
{
    protected $fillable = ['exchange','exchname','franchise_count','franchise_id', 'franchise_name', 'provider_name','effect_date','charge_type','share_charge'];
}
