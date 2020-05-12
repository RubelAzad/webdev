<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['hash', 'name','new_name', 'mimetype', 'extension', 'description', 'user_id', 'disk', 'path'];
    protected $fillable = ['hash', 'name','new_name', 'mimetype', 'extension', 'description', 'user_id', 'disk', 'path'];

}
