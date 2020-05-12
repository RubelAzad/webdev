<?php

namespace Modules\Enquiry\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function view_enquiry_subject(User $user){
        return $user->isAllowed('view_enquiry_subject');
    }

    public function add_enquiry_subject(User $user){
        return $user->isAllowed('add_enquiry_subject');
    }

    public function edit_enquiry_subject(User $user){
        return $user->isAllowed('edit_enquiry_subject');
    }

    public function delete_enquiry_subject(User $user){
        return $user->isAllowed('delete_enquiry_subject');
    }
}
