<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SiteFaq extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['question', 'answer', 'position', 'cat_id', 'active', 'author_id', 'editor_id'];
    protected $fillable = ['question', 'answer', 'position', 'cat_id', 'active', 'author_id', 'editor_id'];
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

    public function cat(){
        return $this->belongsTo('\Modules\Site\Entities\SiteFaqCategory', 'cat_id');
    }
}
