<?php

namespace Modules\Agent\Http\Controllers;

use App\Notifications\EmployeeAccountCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\File;
use App\User;
use App\DocumentType;
use Modules\Agent\Entities\Agent;
use Gate;
use Modules\Agent\Entities\AgentDocument;
use Modules\Agent\Entities\AgentEmployee;
use Modules\Franchise\Entities\Franchise;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Zone;
use Storage;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        if (Gate::denies('view_all_agents', Agent::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $franchise_id = session('franchise'); // session should have it already
        if($franchise_id){
            $franchise = Franchise::find($franchise_id);
            $agents = $franchise->agents;
        }else{
            $franchise = '';
            $agents = Agent::all();
        }

        $data['franchise'] = $franchise;
        $data['agents'] = $agents;

        session(['agent_url' => 'agent']);

        return view('agent::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id = 0){

        if( ! Franchise::active()->get()->count() ){
            flash()->error('You must add a franchise before adding an agent!')->important();
            return redirect()->back();
        }

        if (Gate::denies('create_agent', Agent::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }


        $data = array();
        $agent = '';
        $director = '';
        if($id){
            $agent = Agent::find($id);
        }

        if($agent && $agent->officers->count()){
            $director = $agent->officers->first();
        }
        $data['agent'] = $agent;
        $data['director'] = $director;

        $franchise_id = session('franchise');
        $franchise = '';
        if($franchise_id){
            $franchise = Franchise::find($franchise_id);
            $countries = get_countries_for_select($franchise->area);
        }else{
            $countries = get_countries_for_select();
        }

        $franchises = [];
        if($agent){
            $franchises = Franchise::where('country', '=', $agent->country)->get()->pluck('name','id' )->prepend('', '');
        }

        $zones = [];
        if($agent){
            $zones = Zone::where('country_code', '=', $agent->country)->get()->pluck('name','id' )->prepend('', '');
        }


        $data['franchise'] = $franchise;
        $data['countries'] = $countries;
        $data['franchises'] = $franchises;
        $data['zones'] = $zones;

        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('agent::create', $data);
    }

    public function edit($id = 0){
        $allowed = true;
        if (Gate::denies('create_agent', Agent::class)){
            $allowed = false;
        }

        if (Gate::denies('edit_agent', Agent::class)){
            $allowed = false;
        }

        if(! $allowed){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $agent = '';
        $director = '';
        if($id){
            $agent = Agent::find($id);
        }

        if($agent && $agent->officers->count()){
            $director = $agent->officers->first();
        }
        $data['agent'] = $agent;
        $data['director'] = $director;

        $franchise_id = session('franchise');
        $franchise = '';
        if($franchise_id){
            $franchise = Franchise::find($franchise_id);
            $countries = get_countries_for_select($franchise->area);
        }else{
            $countries = get_countries_for_select();
        }

        $franchises = [];
        if($agent){
            $franchises = Franchise::where('country', '=', $agent->country)->get()->pluck('name','id' )->prepend('', '');
        }

        $zones = [];
        if($agent){
            $zones = Zone::where('country_code', '=', $agent->country)->get()->pluck('name','id' )->prepend('', '');
        }

        $data['franchise'] = $franchise;
        $data['countries'] = $countries;
        $data['franchises'] = $franchises;
        $data['zones'] = $zones;

        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('agent::edit', $data);
    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id){

        if ( ! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }

        $agent = Agent::find($id);

        $allowed = false;

        if ( ! Gate::denies('view_agent', $agent) ){
            $allowed = true;
        }

        if ( ! Gate::denies('view_my_agent', $agent)){
            $allowed = true;
        }

        if ( ! $allowed){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        if( ! $agent->completed){
            return redirect('agent/create/' . $id);
        }


        $data['agent'] = $agent;
        $data['countries'] = get_countries_for_select();
        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('agent::show', $data);
    }


    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update_business_info(Request $request){

        if($request->agent_id){
            // I have the agent already, so update it
            $agent = Agent::find($request->agent_id);
        }else{
            // I don't have a agent yet, create new
            $agent = new Agent;
        }

        $agent->name = $request->account;
        $agent->address_line_1 = $request->address_line_1;
        $agent->address_line_2 = $request->address_line_2;
        $agent->address_line_3 = $request->address_line_3;
        $agent->city = $request->city;
        $agent->county = $request->county;
        $agent->postcode = $request->postcode;
        $agent->country = $request->country;
        $agent->ch_number = $request->ch_number;
        $agent->vat_number = $request->vat_number;

        $franchise_id = session('franchise'); // session should have it already
        if($franchise_id){
            $franchise = Franchise::find($franchise_id);
            $agent->franchise_id = $franchise->id;
        }


        if($agent->save()){
            return $agent;
        }

        return [0];

    }

    public function add_new_officer(Request $request){

        $agent = Agent::find($request->agent_id);

        if($request->employee_id){
            $director = AgentEmployee::find($request->employee_id);
        }else{
            $director = new AgentEmployee;
        }

        $director->name = $request->director_name;
        $director->address_line_1 = $request->director_address_line_1;
        $director->address_line_2 = $request->director_address_line_2;
        $director->address_line_3 = $request->director_address_line_3;
        $director->city = $request->director_city;
        $director->county = $request->director_county;
        $director->postcode = $request->director_postcode;
        $director->country = $agent->country; //$request->director_country;
        $director->phone_number = $request->director_phone_number;
        $director->email = $request->director_email;
        $director->type_id = $request->officer_type_id;

        $role_id = get_role_id_by_designation_id($request->officer_type_id);
        $director->role_id = $role_id;

        $agent->officers()->save($director);

        if($director->email){
            // check this email address has an user account
            $user = User::where('email', $director->email)->get()->first();

            if($user){
                // user exist
            }else{
                // create a new user for this director
                $user = new User;
                $user->name = $director->name;
                $user->email = $director->email;
                $user->phone_number = $director->phone_number;
                $user->active = 1;
                $user->verify_token = md5(time());
                $user->password = bcrypt('123456');

                if($user->save()){
                    // send the password email to the user
                    $user->notify(new EmployeeAccountCreated($user));
                }

                // attach role to user
                $user->roles()->attach($role_id); // agent director role id

                // this user has specific role for this agent only
                $user->agent_roles()->save($director);

            }
        }

        return $agent;

    }

    public function get_employee(Request $request){
        $employee = AgentEmployee::find($request->employee_id);

        return $employee;

    }

    public function update_employee(Request $request){

        $agent = Agent::find($request->agent_id);

        if($request->employee_id){
            $director = AgentEmployee::find($request->employee_id);
        }else{
            $director = new AgentEmployee;
        }

        $director->name = $request->director_name;
        $director->address_line_1 = $request->director_address_line_1;
        $director->address_line_2 = $request->director_address_line_2;
        $director->address_line_3 = $request->director_address_line_3;
        $director->city = $request->director_city;
        $director->county = $request->director_county;
        $director->postcode = $request->director_postcode;
        $director->country = $agent->country;//$request->director_country;
        $director->phone_number = $request->director_phone_number;
        $director->email = $request->director_email;
        $director->type_id = $request->officer_type_id;


        $role_id = get_role_id_by_designation_id($request->officer_type_id);
        $director->role_id = $role_id;

        $agent->officers()->save($director);

        if($director->email){
            // check this email address has an user account
            $user = User::where('email', $director->email)->get()->first();

            if($user){
                // user exist
            }else{
                // create a new user for this director
                $user = new User;
                $user->name = $director->name;
                $user->email = $director->email;
                $user->phone_number = $director->phone_number;
                $user->active = 1;
                $user->verify_token = md5(time());
                $user->password = bcrypt('123456');
                $user->save();

                // attach role to user
                $user->roles()->attach($role_id); // agent director role id

                // this user has specific role for this franchise only
                $user->franchise_roles()->save($director);

            }
        }

        return view('agent::officers', ['officers' => $agent->officers]);
    }

    public function delete_employee($id){
        if (Gate::denies('delete_agent_employees', AgentEmployee::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if( ! $id){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $employee = AgentEmployee::find($id);

        if( ! $employee){
            alert()->error('Incorrect parameter provided!')->persistent('close');
            flash()->error('Incorrect parameter provided!')->important();
            return redirect()->back();
        }

        $agent = $employee->agent;

        if($employee->delete()){
            return [
                'success' => true,
                'msg' => 'Employee has been deleted from ' . $agent->name,
                'employees' => view('agent::officers', ['officers' => $agent->officers])->render()
            ];
        }


        return ['success' => false, 'msg' => 'Something went wrong! Please try again later!'];
    }

    public function update_contact_info(Request $request){

        $agent = Agent::find($request->agent_id);

        $agent->contact_person = $request->contact_person;
        $agent->phone_number = $request->phone_number;
        $agent->ev_phone_number = $request->ev_phone_number;
        $agent->fax_number = $request->fax_number;
        $agent->email = $request->email;

        if($agent->save()){
            $franchises = Franchise::select('id', 'name')->where('country', '=', $agent->country)->get();
            $zones = Zone::select('id', 'name')->where('country_code', '=', $agent->country)->get();
            return ['agent' => $agent, 'franchises' => $franchises, 'zones' => $zones];
        }

        return [0];

    }

    public function update_business_rules(Request $request){


        $agent = Agent::find($request->agent_id);

        $agent->note = $request->note;

        if($request->zone_id){
            $agent->zone_id = $request->zone_id;
        }

        if($request->franchise_id){
            $agent->franchise_id = $request->franchise_id;
        }

        $agent->credit = $request->credit;
        if($request->has('holding_credit')){
            $agent->holding_credit = $request->holding_credit;
        }

        if($request->has('commission')){
            $agent->commission = $request->commission;
        }

        if($request->has('commission_valuable')){
            $agent->commission_valuable = $request->commission_valuable;
        }

        if($request->has('location_charge')){
            $agent->location_charge = $request->location_charge;
        }else{
            $agent->location_charge = 0;
        }

        $agent->additional_charge = $request->additional_charge;

        if($request->has('increment')){
            $agent->increment = $request->increment;
        }

        if($request->has('allow_discount')){
            $agent->allow_discount = 1;
        }else{
            $agent->allow_discount = 0;
        }

        if($request->has('receive')){
            $agent->receive = 1;
        }else{
            $agent->receive = 0;
        }

        if($request->has('pickup')){
            $agent->pickup = 1;
        }else{
            $agent->pickup = 0;
        }

        if($request->has('collection')){
            $agent->collection = 1;
        }else{
            $agent->collection = 0;
        }

        if($request->has('delivery')){
            $agent->delivery = 1;
        }else{
            $agent->delivery = 0;
        }

        if($request->has('visible_website')){
            $agent->visible_website = 1;
        }else{
            $agent->visible_website = 0;
        }

        if($agent->save()){
            return $agent;
        }

        return [0];

    }


    public function add_document(Request $request){

        $agent = Agent::find($request->agent_id);

        $path = 'agent/'.$request->agent_id.'/';
        $hash = md5(time().auth()->id());

        Storage::put($path.$hash, file_get_contents($request->file('file')->getRealPath()));

        $file = new File;

        $file->hash = $hash;
        $file->name = $request->file->getClientOriginalName();
        $file->mimetype = Storage::mimeType($path.$hash);
        $file->extension = $request->file('file')->getClientOriginalExtension();
        $file->disk = config('filesystems.default');
        $file->path = $path;

        $file->uploaded_by = auth()->id();

        if($result = $file->save()){
            // now it time to store this information to the person document
            $document = new AgentDocument;
            $document->file_id = $file->id;
//            $document->agent_id = $request->agent_id;
            $document->doc_type = $request->doc_type;
            $document->uploaded_by = auth()->id();
            //$document->save();
            $agent->documents()->save($document);

            return view('agent::documents', ['documents' => $agent->documents]);
        }

        return [0];

    }

    public function delete_document($id){

        $document = AgentDocument::find($id);
        $agent = $document->agent;

        if (Gate::denies('delete_agent_documents', Agent::class)){
            // ignore delete, return original
            return view('agent::documents', ['documents' => $agent->documents]);
        }

        $document->delete();

        return view('agent::documents', ['documents' => $agent->documents]);
    }

    public function confirm(Request $request){


//        return $request->input();

        $agent = Agent::find($request->agent_id);

        if ($request->hasFile('file')) {
            $hash = md5(time().auth()->id());

//            $path = $request->photo->storeAs('logo', $hash);
            Storage::put($hash, file_get_contents($request->file('file')->getRealPath()));

            $file = new File;

            $file->hash = $hash;
            $file->name = $request->file->getClientOriginalName();
            $file->mimetype = Storage::mimeType($hash);
            $file->extension = $request->file('file')->getClientOriginalExtension();
            $file->disk = config('filesystems.default');
            $file->uploaded_by = auth()->id();

            if($result = $file->save()){
                $agent->logo_id = $file->id;
            }
        }

        if($request->has('activate')){
            $agent->active = 1;
        }else{
            $agent->active = 0;
        }

        if($request->has('approved')){
            $agent->approved = 1;
            $agent->approved_by = auth()->id();
        }else{
            $agent->approved = 0;
        }

        $agent->completed = 1;

        if($agent->save()){
            alert()->success('Agent has been created!')->persistent('Close');
        }

        if( ! $return_url = session('agent_url')){
            $return_url = 'agent';
        }

        return redirect($return_url);

    }

    /*
     * This will change the user status
     * Mainly it will toggle the status
     */
    public function change_status(Request $request){

        $agent = Agent::find($request->id);

        if($agent->active){
            $agent->active = 0;
            $msg = 'Account has been successfully disabled!';
        }else{
            $agent->active = 1;
            $msg = 'Account has been successfully enabled!';
        }

        if($agent->save()){
            activity()->performedOn($agent)->withProperties($agent->toArray())->log($agent->active ? 'Agent activated' : 'Agent de-activated');
            return ['result'=> $agent->active, 'error' => 0, 'msg' => $msg];
        }
        return ['error' => 1, 'msg' => 'Something is wrong. Try again later!'];
    }

    /*
     * This will change the user status
     * Mainly it will toggle the status
     */
    public function change_service_status(Request $request){

        $agent = Agent::find($request->agent_id);

        $service = $request->service;

        $agent->$service = $request->service_status;

        if($agent->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

    /*
     * Delete an user account
     */
    public function delete($id){
        if (Gate::denies('delete_agent', Agent::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        $agent = Agent::find($id);
        if($agent->delete()){
            activity()->performedOn($agent)->log('Agent Deleted');
            alert()->success('Agent account has been deleted!')->persistent('Close');
        }

        return redirect()->back();
    }
}
