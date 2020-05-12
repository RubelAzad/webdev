<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Agent\Entities\Agent;
use Modules\Franchise\Entities\Franchise;
use Modules\Location\Entities\Country;
use Modules\Service\Entities\Service;
use Illuminate\Support\Facades\Gate;
use Modules\Service\Entities\ServiceProvider;
use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Service $services){

        if (Gate::denies('view_service_list', Service::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $data['provider'] = '';

        $franchise = '';
        $agent = '';

        $view = 'service::index';


        $conadd = DB::table('cuscommissions')->get();

        foreach($conadd as $conall){
            $charadd=$conall->chargesetup;
        }

    

        if($franchise_id = session('franchise')){
            $franchise = Franchise::find($franchise_id);
            $services = $services->where('src_country', $franchise->country);
            $view = 'service::franchise';
        }else if($agent_id = session('agent')){
            $agent = Agent::find($agent_id);
            $services = $services->join('cuscommissions', 'cuscommissions.chargesetup', '=', 'services.name')
                ->select('cuscommissions.*','services.*')
                ->where('cuscommissions.franchise_id','=',$agent->id);
            $view = 'service::agent';
             /* $agentid=$agent->id;
            foreach($services as $ser)
            $serid=$ser->fid;
            var_dump($serid.' '.$agentid);
            exit(); */


          /* return view('service::agent')->with(['services'=>$services,'agent'=>$agent]); */

        }

        $data['franchise'] = $franchise;
        $data['agent'] = $agent;

        $data['services'] = $services->get();

        return view($view, $data);
    }
    public function chargesetup(){

        return view('service::charge-setup');
    }

    public function src_country($code){
        $data = array();

        $country = get_country_by_iso_3166_3($code);


        $services = Service::where('src_country', '=', $code)->get();
        $data['services'] = $services;

        $data['provider'] = '';

        $franchise = '';
        $agent = '';

        $view = 'service::src-country-ho';

        if($franchise_id = session('franchise')){
            $franchise = Franchise::find($franchise_id);
            $view = 'service::src-country-franchise';
        }
        if($agent_id = session('agent')){
            $agent = Agent::find($agent_id);
            $view = 'service::src-country-agent';
        }
        $data['franchise'] = $franchise;
        $data['agent'] = $agent;
        $data['country'] = $country;

        return view($view, $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($provider_id = ''){

        if (Gate::denies('add_new_service', Service::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['providers'] = ServiceProvider::active()->get();

        $provider = '';
        if($provider_id){
            $provider = ServiceProvider::find($provider_id);
        }
        $data['country'] = '';

        $data['provider'] = $provider;

        return view('service::create', $data);
    }

    public function create_src_country($code = ''){

        if (Gate::denies('add_new_service', Service::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['providers'] = ServiceProvider::active()->get();

        $provider = '';
        $country = get_country_by_iso_3166_3($code);
        $data['country'] = $country;

        $data['provider'] = $provider;


        return view('service::create', $data);
    }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id = ''){
        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('edit_service', Service::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $service = Service::find($id);
        $data['service'] = $service;
        $data['providers'] = ServiceProvider::active()->get();

        $country = get_country_by_iso_3166_3($service->src_country);
        $data['country'] = $country;

        return view('service::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){
        if($request->service_id){
            // update existing
            $service = Service::find($request->service_id);
        }else{
            // create new
            $service = new Service;
        }

        $sname = $request->name;
        $sdescription = $request->description;
        $sprovider_id = $request->provider_id;
        $sbase_price = $request->base_price ? $request->base_price : 0;
        $ssrc_country = $request->src_country;
        $sdst_country = $request->dst_country;
        $sitem_type = $request->item_type;
        $sspeed = $request->speed;
        $scommission = $request->commission;

        foreach ($request->addslab as $reques) {

            $service->name = $sname;
            $service->description = $sdescription;
            $service->provider_id = $sprovider_id;
            $service->base_price = $sbase_price;
            $service->src_country = $ssrc_country;
            $service->dst_country = $sdst_country;
            $service->item_type = $sitem_type;
            $service->speed = $sspeed;
            $service->commission = $scommission;
            $service->minimum_weight = $reques['minimum_weight'];
            $service->maximum_weight = $reques['maximum_weight'];
            $service->price = $reques['price'];




            if($request->has('active')){
                $service->active = true;
            }else{
                $service->active = false;
            }

            $data=array("name"=>$service->name,"description"=>$service->description,"provider_id"=>$service->provider_id,"base_price"=>$service->base_price,"src_country"=>$service->src_country,"dst_country"=>$service->dst_country,"item_type"=>$service->item_type,"speed"=>$service->speed,"commission"=>$service->commission,"minimum_weight"=>$service->minimum_weight,"maximum_weight"=>$service->maximum_weight,"price"=>$service->price);

            $service->insert($data);
        
            /* if($service->save()){
                flash()->success('Service has been updated!')->important();
                alert()->success('Service has been updated!')->persistent('Close');
            } */

        }
        return redirect('service');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id = ''){
        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('delete_service', Service::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $service = Service::find($id);

        if($service->delete()){
            flash()->success('Service provider has been deleted!')->important();
        }

        return redirect()->back();
    }

    public function provider($id = ''){

        if($id){
            // show one service provider
            return $this->show_service_provider($id);
        }

        // show all service provider list
        return $this->show_service_provider_list();
    }

    public function show_service_provider_list(){

        if (Gate::denies('view_service_provider_list', ServiceProvider::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $providers = ServiceProvider::all();
        $data['providers'] = $providers;


        return view('service::provider.index', $data);
    }

    public function show_service_provider($id){

        if (Gate::denies('view_service_provider', ServiceProvider::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $provider = ServiceProvider::find($id);
        $data['provider'] = $provider;

        $franchise = '';
        $agent = '';

        if($franchise_id = session('franchise')){
            $franchise = Franchise::find($franchise_id);
        }
        if($agent_id = session('agent')){
            $agent = Agent::find($agent_id);
        }
        $data['franchise'] = $franchise;
        $data['agent'] = $agent;

        return view('service::provider.view', $data);
    }

    public function create_provider(){
        if (Gate::denies('add_new_service_provider', ServiceProvider::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        return view('service::provider.create', $data);
    }

    public function edit_provider($id = ''){

        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('edit_service_provider', ServiceProvider::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $provider = ServiceProvider::find($id);
        $data['provider'] = $provider;

        return view('service::provider.edit', $data);
    }

    public function update_provider(Request $request){
        if($request->provider_id){
            // update existing
            $provider = ServiceProvider::find($request->provider_id);
        }else{
            //create new
            $provider = new ServiceProvider;
        }

        $provider->name = $request->name;
        $provider->description = $request->description;

        if($request->has('active')){
            $provider->active = true;
        }else{
            $provider->active = false;
        }

        if($provider->save()){
            flash()->success('Service provider has been updated!')->important();
        }

        return redirect('service/provider');
    }

    public function delete_provider($id = ''){
        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('delete_service_provider', ServiceProvider::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $provider = ServiceProvider::find($id);

        if($provider->delete()){
            flash()->success('Service provider has been deleted!')->important();
        }

        return redirect()->back();
    }


    public function get_dst_country_by_src(Request $request){

        $src_countries = Service::select('dst_country')->where('src_country', '=', $request->src_country)->distinct()->get();

        $countries =  Country::select('name', 'iso_3166_3')->whereIn('iso_3166_3', $src_countries->pluck('dst_country'))->get();

        return $countries;
    }
}
