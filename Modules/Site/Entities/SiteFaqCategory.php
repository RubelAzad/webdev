<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteFaqCategory extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['name', 'position', 'icon','active'];
    protected $fillable = ['name', 'position', 'icon', 'active'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function faqs(){
        return $this->hasMany('Modules\Site\Entities\SiteFaq', 'cat_id');
    }
}
