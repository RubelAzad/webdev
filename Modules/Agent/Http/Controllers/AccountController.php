<?php

namespace Modules\Agent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agent\Entities\Agent;
use Modules\Agent\Entities\AgentPayment;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id = ''){

        if($id){
            $agent_id = $id;
        }else{
            $agent_id = session('agent');
        }

        if($agent_id){
            $agent = Agent::find($agent_id);

            $data = array();
            $data['agent'] = $agent;

            $current_balance = $agent->payments->sum('amount') - $agent->accounts->sum('amount');
            $data['current_balance'] = $current_balance;

            $data['available_limit'] = $agent->credit + $current_balance;

            return view('agent::account.index', $data);
        }

        // if looking from head office, no agent has been selected

        $agents = Agent::active()->get();
        $data['agents'] = $agents;

        return view('agent::account.list', $data);

    }
    public function agent_commission($id = ''){
        if($id){
            $agent_id = $id;
        }else{
            $agent_id = session('agent');
        }
        if($agent_id){
            $agent = Agent::find($agent_id);

            $data = array();
            $data['agent'] = $agent;

            $current_balance = $agent->payments->sum('amount') - $agent->accounts->sum('amount');
            $data['current_balance'] = $current_balance;

            $data['available_limit'] = $agent->credit + $current_balance;

            return view('agent::account.agent_commission', $data);
        }
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function receive_payment()
    {

        $data = array();

        $agents = Agent::active()->get();
        $data['agents'] = $agents;

        $data['payment'] = '';

        return view('agent::account.receive_payment', $data);
    }

    public function edit_payment($id)
    {

        $data = array();

        $agents = Agent::active()->get();
        $data['agents'] = $agents;

        $data['payment'] = AgentPayment::find($id);

        return view('agent::account.edit_payment', $data);
    }

    public function update_payment(Request $request){

        if($request->payment_id){
            $payment = AgentPayment::find($request->payment_id);
        }else{
            $payment = new AgentPayment;
            $payment->date = now();
        }

        $payment->agent_id = $request->agent_id;
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->payment_reference = $request->payment_reference;
        $payment->description = $request->description;

        if($payment->save()){
            alert()->success('Payment has been updated!')->persistent('Close');
        }else{
            alert()->error('Something went wrong, please try again later!')->persistent('Close');
        }

        return redirect('agent/account/' . $request->agent_id);
    }

    public function payment_history($id = ''){

        $data = array();

        if($id){
            $agent = Agent::find($id);
            $payments = AgentPayment::where('agent_id', $id)->get();
        }else{
            $agent = '';
            $payments = AgentPayment::all();
        }

        $data['payments'] = $payments;
        $data['agent'] = $agent;

        return view('agent::account.payment-history', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('agent::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
