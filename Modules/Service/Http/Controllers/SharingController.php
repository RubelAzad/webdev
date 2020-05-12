<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Service\Entities\Sharing;
class SharingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('service::sharing-setup');
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
    public function sharestore(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'desc' => 'required',
            'sharing' => 'required',
            'direction' => 'required',
            'charge' => 'required',
            'addmore.*.name' => 'nullable',
            'addmore.*.qty' => 'nullable',
            'addmore.*.income' => 'nullable',
            'addmore.*.price' => 'nullable',
        ]);

        $code = $request->input('code');
        $desc = $request->input('desc');
        $sharing = $request->input('sharing');
        $direction = $request->input('direction');
        $charge = $request->input('charge');
        $share_per = $request->input('share_per');
        $share_mini = $request->input('share_mini');
        $share_fixed = $request->input('share_fixed');

        foreach ($request->addmore as $key => $value) {

            $min_amount= $value['name'];
            $max_amount= $value['qty'];
            $income= $value['income'];
            $charge_amount= $value['price'];
            if( $share_per > 0 && $share_mini >= 0){
                $min_amount = 0;
                $max_amount = 0;
                $income = 0;
                $charge_amount =0;
                $share_fixed = 0;
                $data=array('code'=>$code,"desc"=>$desc,"sharing"=>$sharing,"direction"=>$direction,"charge"=>$charge,"share_per"=>$share_per,"share_mini"=>$share_mini,"share_fixed"=>$share_fixed,"min_amount"=>$min_amount,"max_amount"=>$max_amount,"income"=>$income,"charge_amount"=>$charge_amount);
                DB::table('sharestup')->insert($data);
            }elseif($share_fixed > 0){
                $share_per = 0;
                $share_mini = 0;
                $min_amount = 0;
                $max_amount = 0;
                $income = 0;
                $charge_amount =0;

                $data=array('code'=>$code,"desc"=>$desc,"sharing"=>$sharing,"direction"=>$direction,"charge"=>$charge,"share_per"=>$share_per,"share_mini"=>$share_mini,"share_fixed"=>$share_fixed,"min_amount"=>$min_amount,"max_amount"=>$max_amount,"income"=>$income,"charge_amount"=>$charge_amount);
                DB::table('sharestup')->insert($data);
            }
            else{
                $share_per = 0;
                $share_mini = 0;
                $share_fixed = 0;

                $data=array('code'=>$code,"desc"=>$desc,"sharing"=>$sharing,"direction"=>$direction,"charge"=>$charge,"share_per"=>$share_per,"share_mini"=>$share_mini,"share_fixed"=>$share_fixed,"min_amount"=>$min_amount,"max_amount"=>$max_amount,"income"=>$income,"charge_amount"=>$charge_amount);
                DB::table('sharestup')->insert($data);
            }
            

        }
        return view('service::sharing-setup');


    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function sharelist()
    {
        $chargelist=DB::table('sharestup')->distinct()->select('code','desc','sharing','direction','charge')->get();
        //$chargelist=DB::table('chargesetup')->get();
    	return view('service::share-setup-list', compact('chargelist'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function editshare()
    {
        $data = array();
        $editcharges=DB::table('sharestup')->where('code', $name)->get();

        $data['editcharges'] = $editcharges;

        # Return the view
        return view('service::edit-share',$data);
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
