<?php

namespace App\Listeners;

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        //logger()->info(json_encode(['event' => $event->user, 'Logged_user' => auth()->user(), 'session' => session('orig_user')]));


        // if event user id and logged in user id doesn't match means they have logged in on behalf. This should not be recorded as real.
        $actual_user = auth()->user();
        $current_user = $event->user;

        if( $current_user->id == $actual_user->id ){
            $current_user->last_login = Carbon::now();
            $current_user->save();
        }


        if($current_user->franchise_employee){
            $franchise = $current_user->franchise_employee->franchise;
            session(['franchise' => $franchise->id]);
            session(['franchise_name' => $franchise->name]);
            session(['current_franchise' => $franchise]);
        }else{
            session(['franchise' => null]);
            session(['franchise_name' => null]);
            session(['current_franchise' => null]);
        }

        if($current_user->agent_employee){
            $agent = $current_user->agent_employee->agent;
            session(['agent' => $agent->id]);
            session(['agent_name' => $agent->name]);
            session(['current_agent' => $agent]);
        }else{
            session(['agent' => null]);
            session(['agent_name' => null]);
            session(['current_agent' => null]);
        }




    }
}
