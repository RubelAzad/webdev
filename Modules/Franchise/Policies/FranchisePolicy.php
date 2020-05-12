<?php

namespace Modules\Franchise\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Franchise\Entities\Franchise;

class FranchisePolicy
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

    public function view_all_franchises(User $user){
        if(session('agent')){
            // if logged in as agent
            return false;
        }

        return $user->isAllowed('view_all_franchises' );
    }
    public function create_franchise(User $user){ return $user->isAllowed('create_franchise' ); }
    public function view_franchise(User $user){ return $user->isAllowed('view_franchise' );}
    public function view_my_franchise(User $user, Franchise $franchise){

        if(session('franchise') == $franchise->id){
            return true;
        }

        return false;
    }
    public function edit_franchise(User $user){ return $user->isAllowed('edit_franchise' ); }
    public function activate_franchise(User $user){ return $user->isAllowed('activate_franchise' ); }
    public function approve_franchise(User $user){ return $user->isAllowed('approve_franchise' ); }
    public function delete_franchise(User $user){ return $user->isAllowed('delete_franchise' ); }

    public function view_my_agents(User $user){
        if($user->franchise_roles->count()){
            return true;
        }

        return false;
    }
}
