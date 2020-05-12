<?php

namespace Modules\Agent\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Agent\Entities\Agent;

class AgentPolicy
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

    public function view_all_agents(User $user){ return $user->isAllowed('view_all_agents' ); }
    public function create_agent(User $user){ return $user->isAllowed('create_agent' ); }
    public function view_agent(User $user, Agent $agent){

        // if currently logged in agent
        if(session('agent') === $agent->id){
            return true;
        }

        if(session('franchise') === $agent->franchise_id){
            return true;
        }

        return $user->isAllowed('view_agent' );
    }
    public function view_my_agent(User $user, Agent $agent){

        if(session('agent') == $agent->id){
            return true;
        }

        return false;
    }
    public function edit_agent(User $user){
        if(session('agent')){
            return false;
        }
        return $user->isAllowed('edit_agent' );
    }
    public function activate_agent(User $user){ return $user->isAllowed('activate_agent' ); }
    public function approve_agent(User $user){ return $user->isAllowed('approve_agent' ); }
    public function delete_agent(User $user){ return $user->isAllowed('delete_agent' ); }

    public function view_agent_account(User $user, Agent $agent){
        return $user->isAllowed('view_agent_account' );
    }

    public function receive_payment(User $user){
        return $user->isAllowed('receive_payment' );
    }

    public function edit_payment(User $user){
        return $user->isAllowed('edit_payment' );
    }
}
