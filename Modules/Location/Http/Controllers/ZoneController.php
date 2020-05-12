<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\Zone;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        $data = array();
        $zones = Zone::all();
        $data['zones'] = $zones;
        $country = '';
        $data['country'] = $country;

        return view('location::zone.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        $data = array();
        $data['countries'] = get_countries_for_select();
        $country = '';
        $data['country'] = $country;
        $data['zone'] = '';

        return view('location::zone.create', $data);
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
    public function show(){

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id){

        if( ! $id){
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $data = array();

        $data['countries'] = get_countries_for_select();
        $country = '';
        $data['country'] = $country;

        $zone = Zone::find($id);
        $data['zone'] = $zone;

        return view('location::zone.create', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){
        if($request->zone_id){
            $zone = Zone::find($request->zone_id);
        }else{
            $zone = new Zone;
        }

        $zone->name = $request->name;
        $zone->country_code = $request->country;
        $zone->receive = $request->receive;
        $zone->pickup = $request->pickup;
        $zone->collection = $request->collection;
        $zone->delivery = $request->delivery;

        if($zone->save()){
            flash()->success('Zone list has been update!')->important();
        }else{
            flash()->error('Zone list could not be update! Please try again later!')->important();
        }

        return redirect('zone');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id  = ''){
        if( ! $id){
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $zone = Zone::find($id);

        if($zone){
            if($zone->delete()){
                flash()->success('Zone has been deleted!')->important();
            }
        }

        return redirect()->back();
    }
}
