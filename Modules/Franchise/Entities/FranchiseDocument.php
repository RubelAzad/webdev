<?php

namespace Modules\Franchise\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class FranchiseDocument extends Model
{
    use LogsActivity, SoftDeletes;
    protected $fillable = ['file_id', 'doc_type', 'franchise_id', 'uploaded_by'];
    protected static $logAttributes = ['file_id', 'doc_type', 'franchise_id', 'uploaded_by'];

    protected $dates = ['deleted_at'];

    public function franchise(){
        return $this->belongsTo('Modules\Franchise\Entities\Franchise', 'franchise_id');
    }

    public function actual_file(){
        return $this->belongsTo('App\File', 'file_id');
    }

    public function type(){
        return $this->belongsTo('App\DocumentType', 'doc_type');
    }
}
