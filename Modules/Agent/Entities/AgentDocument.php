<?php

namespace Modules\Agent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentDocument extends Model
{
    use LogsActivity, SoftDeletes;
    protected $fillable = ['file_id', 'doc_type', 'agent_id', 'uploaded_by'];
    protected static $logAttributes = ['file_id', 'doc_type', 'agent_id', 'uploaded_by'];

    protected $dates = ['deleted_at'];

    public function agent(){
        return $this->belongsTo('Modules\Agent\Entities\Agent', 'agent_id');
    }

    public function actual_file(){
        return $this->belongsTo('App\File', 'file_id');
    }

    public function type(){
        return $this->belongsTo('App\DocumentType', 'doc_type');
    }
}
