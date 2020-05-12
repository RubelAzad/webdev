<?php

namespace Modules\Pickup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agent\Entities\Agent;
use Modules\Pickup\Entities\Pickup;

class PickupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        $data = array();
        $pickups = Pickup::active()->get();
        $data['pickups'] = $pickups;
        return view('pickup::index', $data);
    }

    public function history(){
        $data = array();
        $pickups = Pickup::archive()->get();
        $data['pickups'] = $pickups;
        return view('pickup::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pickup::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id = ''){
        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('Close');
            return redirect()->back();
        }
        $data =array();
        $pickup = Pickup::find($id);
        $data['pickup'] = $pickup;
        $agents = Agent::active()->where('country', '=', $pickup->country_code)->get();
        $data['agents'] = $agents;

        return view('pickup::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pickup::edit');
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

    public function assign_agent(Request $request){
        $pickup = Pickup::find($request->pickup_id);

        $pickup->agent_id = $request->agent_id;

        if($pickup->save()){
            return [
                'name' => $pickup->agent->name,
                'contact_person' => $pickup->agent->contact_person,
                'number' => $pickup->agent->phone_number,
                'city' => $pickup->agent->city,
            ];
        }

    }

    public function pickup_request_to_agent(){
        $data = array();

        $pickups = collect();
        $data['pickups'] = $pickups;

        return view('pickup::agent', $data);
    }
}
