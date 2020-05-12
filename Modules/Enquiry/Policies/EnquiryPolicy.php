<?php

namespace Modules\Enquiry\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Enquiry\Entities\Enquiry;

class EnquiryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view_all_enquiry(User $user){
        return $user->isAllowed('view_all_enquiry');
    }

    public function view_enquiries_belongs_to_agent(User $user){
        if( ! session('agent')) return false;
        return $user->isAllowed('view_enquiries_belongs_to_agent');
    }

    public function view_enquiry_details(User $user, Enquiry $enquiry){
        return $user->isAllowed('view_enquiry_details');
    }

    public function forward_enquiry(User $user, Enquiry $enquiry){
        return $user->isAllowed('forward_enquiry');
    }

    public function reply_enquiry(User $user, Enquiry $enquiry){
        return $user->isAllowed('reply_enquiry');
    }

}
