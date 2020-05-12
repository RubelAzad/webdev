<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Agent\Entities\Agent;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $data = array();

        $user  = auth()->user();
        //return $user->franchise_roles->count();

        //return $request->session()->all();

      /**if($user->hasRole('user')){
            //return redirect('user/dashboard');
            $view = 'user-dashboard';
        }*/
        if(session('user')){
            //return redirect('user/dashboard');
            $view = 'back-end.dashboard.user';
        }elseif(session('agent')){
            $agent = Agent::find(session('agent'));

            $data['agent'] = $agent;

            $current_balance = $agent->payments->sum('amount') - $agent->accounts->sum('amount');
            $data['current_balance'] = $current_balance;

            $data['available_limit'] = $agent->credit + $current_balance;

            $view = 'back-end.dashboard.agent';
        }elseif (session('franchise')){
            $view = 'back-end.dashboard.franchise';
        }else{
            $view = 'back-end.dashboard.index';
        }

        return view($view, $data);
    }
}
