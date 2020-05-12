<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteSlideShow extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['title', 'description', 'image', 'button1_text', 'button1_link', 'button2_text', 'button2_link', 'active'];
    protected $fillable = ['title', 'description', 'image', 'button1_text', 'button1_link', 'button2_text', 'button2_link', 'active'];

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
