<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteNews extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['title', 'slug', 'body', 'image', 'author_id', 'editor_id', 'active', 'front_page'];
    protected $fillable = ['title', 'slug', 'body', 'image', 'author_id', 'editor_id', 'active', 'front_page'];
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
