<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Service\Entities\CustomerCommission;

class CustomerCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('service::customer-commission');
    }
    

    public function comShare()
    {
        $allagent= DB::table("agents")->distinct()->select('country')->get();
        $exchange=DB::table("franchises")->get();
        $providesss=DB::table("service_providers")->get();
        $chargesetup=DB::table("services")->distinct()->select('name','description')->get();
        $countries=DB::table("countries")->orderBy('name')->get();

        return view('service::customer-commission')->with(['allagent'=>$allagent,'exchange'=>$exchange,'providesss'=>$providesss,'countries'=>$countries,'chargesetup'=>$chargesetup]);
    }
    
    public function comShareName($id)
    {
        $states = DB::table("agents")->where('country', $id)->pluck('id', 'id');
        return response()->json($states);
    }
    public function comShareCity($id)
    {
        $states = DB::table("agents")->where('id', $id)->pluck('name', 'id');
        return response()->json($states);
    }

    public function comCountName($id)
    {
        $states = DB::table("countries")->where('id', $id)->pluck('currency', 'id');
        return response()->json($states);
    }
    public function comExchangeName($id)
    {
        $states = DB::table("franchises")->where('id', $id)->pluck('name', 'id');
        return response()->json($states);
    }

    public function customerCommissionInsert(Request $request)
    {
        $request->validate([
            'exchange' => 'required',
            'exchname' => 'required',
            'franchise_count' => 'required',
            'franchise_id' => 'required',
            'franchise_name' => 'required',
            'provider_name' => 'required',
            'effect_date' => 'required',
            'soureccountry' => 'required',
            'destcountry' => 'required',
            'chargesetup' => 'required',
        ]);
        $exchange = $request->input('exchange');
        $exchname = $request->input('exchname');
        $franchise_count = $request->input('franchise_count');
        $franchise_id = $request->input('franchise_id');
        $franchise_name = $request->input('franchise_name');
        $provider_name = $request->input('provider_name');
        $effect_date = $request->input('effect_date');
        $soureccountry = $request->input('soureccountry');
        $destcountry = $request->input('destcountry');
        $chargesetup = $request->input('chargesetup');

        $data=array("exchange"=>$exchange,"exchname"=>$exchname,"franchise_count"=>$franchise_count,"franchise_id"=>$franchise_id,"franchise_name"=>$franchise_name,"provider_name"=>$provider_name,"effect_date"=>$effect_date,"soureccountry"=>$soureccountry,"destcountry"=>$destcountry,"chargesetup"=>$chargesetup);
        DB::table('cuscommissions')->insert($data);
        
        return view('service::customer-commission');

    }

    public function cutomerCommissionList(){
        $customercomlist=DB::table("cuscommissions")->get();
        return view('service::customer-commission-list', compact('customercomlist'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('service::create');
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
    public function show()
    {
        return view('service::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('service::edit');
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
