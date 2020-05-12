<?php

namespace Modules\Shipment\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\CargoPost;
use Modules\Shipment\Entities\HouseAirWayBill;
use Modules\Shipment\Entities\HouseAirWayBillDetails;
use Modules\Shipment\Entities\MasterAirWayBill;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('shipment::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('shipment::create');
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
        return view('shipment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('shipment::edit');
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

    public function hawb(){
        $data = array();
        $hawbs = HouseAirWayBill::all();
        $data['hawbs'] = $hawbs;

        return view('shipment::hawb.index', $data);
    }

    public function show_hawb($id){
        $data = array();
        $hawb = HouseAirWayBill::find($id);
        $data['hawb'] = $hawb;

        return view('shipment::hawb.show', $data);
    }

    public function create_hawb(){
        $data = array();

        return view('shipment::hawb.create', $data);
    }

    public function update_hawb(Request $request){

        if($request->hawb_id){
            $hawb = HouseAirWayBill::find($request->hawb_id);
            $hawb->edited_by = auth()->id();
        }else{
            $hawb = new HouseAirWayBill;
            $hawb->created_by = auth()->id();
        }

        $hawb->max_weight = $request->weight;
        if($request->mawb_id){
            $hawb->mawb_id = $request->mawb_id;
        }

        if($hawb->save()){
            alert()->success('House Air Way Bill has been updated!')->persistent('Close');
            return $hawb;
        }else{
            return ['error' => true];
        }

    }

    public function delete_hawb($id){
        if( ! $id){
            alert()->error('Required parameter is missing!')->persistent('Close');
            return redirect()->back();
        }

        $hawb = HouseAirWayBill::find($id);


        if (Gate::denies('delete_hawb', $hawb)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if($hawb->delete()){
            alert()->success('HAWB has been deleted!')->persistent('Close');
        }else{
            alert()->error('Something went wrong! Please ry again later!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function get_hawb($id = ''){
        if($id){
            return HouseAirWayBill::find($id);
        }

        return '0';
    }

    public function add_post_to_hawb(Request $request){
        $post = CargoPost::where('tracking_no', '=', $request->tracking_no)->get()->first();

        $hawb = HouseAirWayBillDetails::where('hawb_id', '=', $request->hawb_id)
            ->where('post_id', '=', $post->id)->get()->first();

        if($hawb){
           return ['status' => 'error', 'msg' => 'This has been processed already!'];
        }

        $hawb = new HouseAirWayBillDetails;
        $hawb->hawb_id = $request->hawb_id;
        $hawb->post_id = $post->id;

        if($hawb->save()){
            return ['status' => 'success', 'msg' => 'Successfully added to this HAWB'];
        }else{
            return ['status' => 'error', 'msg' => 'Something went wrong! Please try again later!'];
        }

    }

    public function edit_hawb($id = ''){
        $data = array();

        return view('shipment::hawb.edit', $data);
    }

    public function mawb(){
        $data = array();
        return view('shipment::mawb.index', $data);
    }

    public function show_mawb($id){
        $data = array();
        $mawb = MasterAirWayBill::find($id);
        $data['mawb'] = $mawb;
        return view('shipment::mawb.show', $data);
    }

    public function create_mawb(){
        $data = array();

        return view('shipment::mawb.create', $data);
    }

    public function edit_mawb($id = ''){
        $data = array();
        $mawb = MasterAirWayBill::find($id);
        $data['mawb'] = $mawb;
        return view('shipment::mawb.edit', $data);
    }

    public function update_mawb(Request $request){

        if($request->mawb_id){
            $mawb = MasterAirWayBill::find($request->mawb_id);
            $mawb->edited_by = auth()->id();
        }else{
            $mawb = new MasterAirWayBill;
            $mawb->created_by = auth()->id();
        }

        $mawb->flight_no = $request->flight_no;
        $mawb->flight_date = $request->flight_date ? Carbon::createFromFormat('d/m/Y', $request->flight_date) : null;
        $mawb->max_weight = $request->max_weight;


        if($mawb->save()){
            alert()->success('Master Air Way Bill has been updated!')->persistent('Close');
        }

        return redirect('shipment/mawb/' . $mawb->id);
    }
}
