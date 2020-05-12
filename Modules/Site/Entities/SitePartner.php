<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SitePartner extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['name', 'logo', 'link', 'description', 'active', 'author_id', 'editor_id'];
    protected $fillable = ['name', 'logo', 'link', 'description', 'active', 'author_id', 'editor_id'];
//    protected $dates = ['expire'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }

    public function editor(){
        return $this->belongsTo('App\User', 'editor_id');
    }
}
