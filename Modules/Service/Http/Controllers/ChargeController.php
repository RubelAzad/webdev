<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Charge;


class ChargeController extends Controller
{

    public function index()
    {
        return view('service::charge-setup');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMorePost(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'desc' => 'required',
            'payment_type' => 'required',
            'fixednum' => 'nullable',
            'addmore.*.name' => 'nullable',
            'addmore.*.qty' => 'nullable',
            'addmore.*.price' => 'nullable',
        ]);
        $name = $request->input('code');
        $description = $request->input('desc');
        $payment_type = $request->input('payment_type');
        $fixednum = $request->input('fixednum');
        
        foreach ($request->addmore as $key => $value) {

            $min_amount= $value['name'];
            $max_amount= $value['qty'];
            $charge_amount= $value['price'];
            if( $fixednum > 0){
                $min_amount = 0;
                $max_amount = 0;
                $charge_amount =0;
                $data=array('name'=>$name,"description"=>$description,"payment_type"=>$payment_type,"fixednum"=>$fixednum,"min_amount"=>$min_amount,"max_amount"=>$max_amount,"charge_amount"=>$charge_amount);
                DB::table('chargesetup')->insert($data);
            }else{
                $fixednum = 0;
                $data=array('name'=>$name,"description"=>$description,"payment_type"=>$payment_type,"fixednum"=>$fixednum,"min_amount"=>$min_amount,"max_amount"=>$max_amount,"charge_amount"=>$charge_amount);
                DB::table('chargesetup')->insert($data);
            }
            

        }
        return view('service::charge-setup');

    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function chargelist()
    {
        $chargelist=DB::table('chargesetup')->distinct()->select('name','description','payment_type')->get();
        //$chargelist=DB::table('chargesetup')->get();
    	return view('service::charge-setup-list', compact('chargelist'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function editcharge($name)
    {
        $data = array();
        $editcharges=DB::table('services')->where('name', $name)->get();

        $data['editcharges'] = $editcharges;

        # Return the view
        return view('service::edit-charge',$data);

        //return view('service::edit-charge', compact('editcharge')); 
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
