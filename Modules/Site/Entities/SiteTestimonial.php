<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteTestimonial extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['text', 'star', 'name', 'occupation', 'active', 'author_id', 'editor_id'];
    protected $fillable = ['text', 'star', 'name', 'occupation', 'active', 'author_id', 'editor_id'];
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
