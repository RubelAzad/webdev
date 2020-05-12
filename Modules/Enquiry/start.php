<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

if( ! function_exists('get_active_enquiries_by_agent')){
    function get_active_enquiries_by_agent($agent_id){

        if( ! $agent_id){
            return false;
        }

        $agent = \Modules\Agent\Entities\Agent::find($agent_id);

        return $agent->enquiries()->where('active', 1);
    }
}

if( ! function_exists('get_subjects')){
    function get_subjects(){
        $subjects = \Modules\Enquiry\Entities\EnquirySubject::all();

        return $subjects;
    }
}

if( ! function_exists('get_attachments')){
    function get_attachments(\Modules\Enquiry\Entities\EnquiryAgent $enquiry){

        $attachments = '';

        if($enquiry->attachments){
            $attachments = \App\File::whereIn('id', explode(',', $enquiry->attachments))->get();
        }

        return $attachments;
    }
}
