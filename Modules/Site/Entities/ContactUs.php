<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactUs extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['cname', 'cdes', 'cphone', 'ctel', 'cmail', 'position', 'active', 'author_id', 'editor_id'];
    protected $fillable = ['cname', 'cdes', 'cphone', 'ctel', 'cmail', 'position', 'active', 'author_id', 'editor_id'];

    public $table='site_contactus';

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

