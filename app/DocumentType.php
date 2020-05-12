<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentType extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name','active'];
    protected $fillable = ['name', 'active'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
