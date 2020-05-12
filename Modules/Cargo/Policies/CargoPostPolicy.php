<?php

namespace Modules\Cargo\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Cargo\Entities\CargoPost;

class CargoPostPolicy
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

    public function create_shipment(User $user){
        //if some one logged in from agent, then allowed
        if(session('agent') && $user->isAllowed('create_shipment')){
            return true;
        }

        return false;
    }

    public function edit_shipment(User $user, CargoPost $post){


        //if some one logged in from agent, then allowed
        if(session('agent')){
            // if already confirmed, this can not be cancel
            if( $post->status_id > 0 ){
                return false;
            }

            return $user->isAllowed('edit_shipment');
        }

        return $user->isAllowed('edit_shipment');
    }

    public function pickup_booking_warehouse(User $user){
        //if some one logged in from agent, then allowed
        if(session('agent') && $user->isAllowed('pickup_booking_warehouse')){
            return true;
        }

        return false;
    }

    public function cancel_shipment(User $user, CargoPost $post){

        // if already confirmed, this can not be cancel
        if( $post->status_id > 0 ){
            return false;
        }

        //if some one logged in from agent, then allowed
        if(session('agent') && $user->isAllowed('cancel_shipment')){
            return true;
        }

        return false;
    }

    public function view_confirmed_booking_list(User $user){
        return $user->isAllowed('view_confirmed_booking_list');
    }


}
