<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agent\Entities\Agent;
use Modules\Franchise\Entities\Franchise;
use Modules\Service\Entities\ServiceValuable;
use Gate;

class ValuableController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ServiceValuable $valuables){

        if (Gate::denies('view_valuables_list', ServiceValuable::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }


        $data = array();


        if(session('agent')){
            $agent = Agent::find(session('agent'));
            $valuables = $valuables->where('src_country', $agent->country);
            $view = 'service::valuable.agent';
        }elseif(session('franchise')){
            $franchise = Franchise::find(session('franchise'));
            $valuables = $valuables->where('src_country', $franchise->country);
            $view = 'service::valuable.franchise';
        }else{
            $view = 'service::valuable.index';
        }

        $data['valuables'] = $valuables->get();


        return view($view, $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('add_new_valuable', ServiceValuable::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        return view('service::valuable.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id){

        $item = ServiceValuable::find($id);

        if (Gate::denies('edit_valuable', $item)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['valuable'] = $item;

        return view('service::valuable.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){
        //return $request->input();

        if($request->valuable_id){
            $itam = ServiceValuable::find($request->valuable_id);
        }else{
            $itam = new ServiceValuable;
        }

        $itam->name             = $request->name;
        $itam->src_country      = $request->src_country;
        $itam->dst_country      = $request->dst_country;
        $itam->price            = $request->price;
        $itam->max_price        = $request->max_price;
        $itam->purchase_price   = $request->purchase_price;
        $itam->commission       = $request->commission;
        $itam->active           = true;

        if($itam->save()){
            alert()->success('A valuable item has been updated!')->persistent('Close!');
        }else{
            alert()->error('Could not be updated! Please try again later!')->persistent('Close!');
        }

        return redirect('service/valuable');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id){
        $item = ServiceValuable::find($id);

        if (Gate::denies('delete_valuable', $item)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }


        if($item->delete()){
            alert()->success('A valuable item has been deleted!')->persistent('Close!');
        }else{
            alert()->error('Could not be deleted! Please try again later!')->persistent('Close!');
        }

        return redirect()->back();

    }
}
