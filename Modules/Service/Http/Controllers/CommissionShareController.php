<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Service\Entities\CommissionShare;

class CommissionShareController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('service::commission-sharing');
    }

    public function shareCommissionall()
    {
        $shareallagent= DB::table("agents")->distinct()->select('country')->get();
        $shareexchange=DB::table("franchises")->get();
        $shareprovidesss=DB::table("service_providers")->get();
        $sharechargesetup=DB::table("sharestup")->distinct()->select('desc')->get();
        return view('service::commission-sharing')->with(['shareallagent'=>$shareallagent,'shareexchange'=>$shareexchange,'shareprovidesss'=>$shareprovidesss,'sharechargesetup'=>$sharechargesetup]);
    }
    public function shareExchangeName($id)
    {
        $exchan = DB::table("franchises")->where('id', $id)->pluck('name', 'id');
        return response()->json($exchan);
    }
    public function shareCommFranCount($id)
    {
        $francon = DB::table("agents")->where('country', $id)->pluck('id', 'id');
        return response()->json($francon);
    }
    public function shareCommFranId($id)
    {
        $franid = DB::table("agents")->where('id', $id)->pluck('name', 'id');
        return response()->json($franid);
    }

    public function ShareCommissionInsert(Request $request)
    {
        $request->validate([
            'exchange' => 'required',
            'exchname' => 'required',
            'franchise_count' => 'required',
            'franchise_id' => 'required',
            'franchise_name' => 'required',
            'provider_name' => 'required',
            'effect_date' => 'required',
            'charge_type' => 'required',
            'share_charge' => 'required',
        ]);
        $exchange = $request->input('exchange');
        $exchname = $request->input('exchname');
        $franchise_count = $request->input('franchise_count');
        $franchise_id = $request->input('franchise_id');
        $franchise_name = $request->input('franchise_name');
        $provider_name = $request->input('provider_name');
        $effect_date = $request->input('effect_date');
        $charge_type = $request->input('charge_type');
        $share_charge = $request->input('share_charge');

        $data=array("exchange"=>$exchange,"exchname"=>$exchname,"franchise_count"=>$franchise_count,"franchise_id"=>$franchise_id,"franchise_name"=>$franchise_name,"provider_name"=>$provider_name,"effect_date"=>$effect_date,"charge_type"=>$charge_type,"share_charge"=>$share_charge);
        DB::table('sharing_commission')->insert($data);
        
        return view('service::commission-sharing');

    }
    public function shareCommissionList(){
        $sharecomlist=DB::table("sharing_commission")->get();
        return view('service::commission-sharing-list', compact('sharecomlist'));
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
