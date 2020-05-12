<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class UserPic extends Model
{
    use SoftDeletes, LogsActivity;
    protected static $logAttributes = ['user_id', 'file_id'];
    protected $fillable = ['user_id', 'file_id'];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function actual_file(){
        return $this->belongsTo('App\File', 'file_id');
    }


}
