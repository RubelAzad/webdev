<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerCommission extends Model
{
    protected $fillable = ['exchange','exchname','franchise_count','franchise_id', 'franchise_name', 'provider_name','effect_date','soureccountry','destcountry','chargesetup'];
}
