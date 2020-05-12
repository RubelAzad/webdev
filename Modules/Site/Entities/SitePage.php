<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SitePage extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['title', 'slug', 'summary', 'body', 'image', 'author_id', 'editor_id', 'active', 'front-page', 'featured', 'position'];
    protected $fillable = ['title', 'slug', 'summary', 'body', 'image', 'author_id', 'editor_id', 'active', 'front-page', 'featured', 'position'];
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
