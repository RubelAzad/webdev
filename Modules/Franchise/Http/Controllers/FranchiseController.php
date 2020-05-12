<?php

namespace Modules\Franchise\Http\Controllers;

use App\DocumentType;
use App\File;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Franchise\Entities\Franchise;
use Modules\Franchise\Entities\FranchiseDocument;
use Modules\Franchise\Entities\FranchiseEmployee;
use Storage;


class FranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        if (Gate::denies('view_all_franchises', Franchise::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['franchises'] = Franchise::all();

        return view('franchise::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id = 0){
        $allowed = true;
        if (Gate::denies('create_franchise', Franchise::class)){
            $allowed = false;
        }

        if (Gate::denies('edit_franchise', Franchise::class)){
            $allowed = false;
        }

        if(! $allowed){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $data = array();
        $franchise = '';
        $director = '';
        if($id){
            $franchise = Franchise::find($id);
        }

        if($franchise && $franchise->employees->count()){
            $director = $franchise->employees->first();
        }
        $data['franchise'] = $franchise;
        $data['director'] = $director;

        $data['countries'] = get_countries_for_select();
        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('franchise::create', $data);
    }

    public function edit($id = 0){
        $allowed = true;
        if (Gate::denies('create_franchise', Franchise::class)){
            $allowed = false;
        }

        if (Gate::denies('edit_franchise', Franchise::class)){
            $allowed = false;
        }

        if(! $allowed){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $franchise = '';
        $director = '';
        if($id){
            $franchise = Franchise::find($id);
        }

        if($franchise && $franchise->employees->count()){
            $director = $franchise->employees->first();
        }
        $data['franchise'] = $franchise;
        $data['director'] = $director;

        $data['countries'] = get_countries_for_select();
        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('franchise::edit', $data);
    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id){

        $data = array();
        $franchise = Franchise::find($id);

        $allowed = false;

        // if any of the above rules allow
        if ( ! Gate::denies('view_franchise', Franchise::class) || ! Gate::denies('view_my_franchise', $franchise)){
            $allowed = true;
        }

        if ( ! $allowed ){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if( ! $franchise->completed){
            return redirect('franchise/create/' . $id);
        }


        $data['franchise'] = $franchise;
        $data['countries'] = get_countries_for_select();
        $data['doc_types'] = DocumentType::active()->get()->pluck('name', 'id')->prepend('', '');

        return view('franchise::show', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update_business_info(Request $request){

        if($request->franchise_id){
            // I have the franchise already, so update it
            $franchise = Franchise::find($request->franchise_id);
        }else{
            // I don't have a franchise yet, create new
            $franchise = new Franchise;
        }

        $franchise->name = $request->account;
        $franchise->address_line_1 = $request->address_line_1;
        $franchise->address_line_2 = $request->address_line_2;
        $franchise->address_line_3 = $request->address_line_3;
        $franchise->city = $request->city;
        $franchise->county = $request->county;
        $franchise->postcode = $request->postcode;
        $franchise->country = $request->country;
        $franchise->ch_number = $request->ch_number;
        $franchise->vat_number = $request->vat_number;

        if($franchise->save()){
            return $franchise;
        }

        return [0];

    }

    public function add_new_officer(Request $request){

        $franchise = Franchise::find($request->franchise_id);

        if($request->employee_id){
            $director = FranchiseEmployee::find($request->employee_id);
        }else{
            $director = new FranchiseEmployee;
        }

        $director->name = $request->director_name;
        $director->address_line_1 = $request->director_address_line_1;
        $director->address_line_2 = $request->director_address_line_2;
        $director->address_line_3 = $request->director_address_line_3;
        $director->city = $request->director_city;
        $director->county = $request->director_county;
        $director->postcode = $request->director_postcode;
        $director->country = $franchise->country;//$request->director_country;
        $director->phone_number = $request->director_phone_number;
        $director->email = $request->director_email;
        $director->type_id = $request->officer_type_id;

        $role_id = get_role_id_by_designation_id($request->officer_type_id);
        $director->role_id = $role_id;

        $franchise->employees()->save($director);

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

        return $franchise;

    }

    public function get_employee(Request $request){
        $employee = FranchiseEmployee::find($request->employee_id);

        return $employee;

    }

    public function update_employee(Request $request){

        $franchise = Franchise::find($request->franchise_id);

        if($request->employee_id){
            $director = FranchiseEmployee::find($request->employee_id);
        }else{
            $director = new FranchiseEmployee;
        }

        $director->name = $request->director_name;
        $director->address_line_1 = $request->director_address_line_1;
        $director->address_line_2 = $request->director_address_line_2;
        $director->address_line_3 = $request->director_address_line_3;
        $director->city = $request->director_city;
        $director->county = $request->director_county;
        $director->postcode = $request->director_postcode;
        $director->country = $franchise->country;//$request->director_country;
        $director->phone_number = $request->director_phone_number;
        $director->email = $request->director_email;
        $director->type_id = $request->officer_type_id;


        $role_id = get_role_id_by_designation_id($request->officer_type_id);
        $director->role_id = $role_id;

        $franchise->employees()->save($director);

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

        return view('franchise::officers', ['officers' => $franchise->employees]);
    }

    public function delete_employee($id){
        if (Gate::denies('delete_franchise_employees', FranchiseEmployee::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if( ! $id){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $employee = FranchiseEmployee::find($id);

        if( ! $employee){
            alert()->error('Incorrect parameter provided!')->persistent('close');
            flash()->error('Incorrect parameter provided!')->important();
            return redirect()->back();
        }

        $franchise = $employee->franchise;

        if($employee->delete()){
            //flash()->success('Employee has been deleted!');
        }


        return view('franchise::officers', ['officers' => $franchise->employees]);
    }

    public function update_contact_info(Request $request){

        $franchise = Franchise::find($request->franchise_id);

        $franchise->contact_person = $request->contact_person;
        $franchise->phone_number = $request->phone_number;
        $franchise->ev_phone_number = $request->ev_phone_number;
        $franchise->fax_number = $request->fax_number;
        $franchise->email = $request->email;

        if($franchise->save()){
            return $franchise;
        }

        return [0];

    }

    public function update_business_rules(Request $request){

        $franchise = Franchise::find($request->franchise_id);

        $franchise->note = $request->note;
        $franchise->area = $request->area ? implode(',', $request->area) : null;
//        $franchise->commission = $request->commission;
//        $franchise->agent_commission = $request->agent_commission;
//        $franchise->discount = $request->discount;
        $franchise->credit = $request->credit;

        if($franchise->save()){
            return $franchise;
        }

        return [0];

    }


    public function add_document(Request $request){

        $franchise = Franchise::find($request->franchise_id);

        $path = 'franchise/'.$request->franchise_id.'/';
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
            $document = new FranchiseDocument;
            $document->file_id = $file->id;
//            $document->franchise_id = $request->franchise_id;
            $document->doc_type = $request->doc_type;
            $document->uploaded_by = auth()->id();
            //$document->save();
            $franchise->documents()->save($document);

            return view('franchise::documents', ['documents' => $franchise->documents]);
        }

        return [0];

    }

    public function delete_document($id){

        $document = FranchiseDocument::find($id);
        $franchise = $document->franchise;

        if (Gate::denies('delete_franchise_documents', Franchise::class)){
            // ignore delete, return original
            return view('franchise::documents', ['documents' => $franchise->documents]);
        }

        $document->delete();

        return view('franchise::documents', ['documents' => $franchise->documents]);
    }

    public function confirm(Request $request){


//        return $request->input();

        $franchise = Franchise::find($request->franchise_id);

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
                $franchise->logo_id = $file->id;
            }
        }

        if($request->has('activate')){
            $franchise->active = 1;
        }else{
            $franchise->active = 0;
        }

        if($request->has('approved')){
            $franchise->approved = 1;
            $franchise->approved_by = auth()->id();
        }else{
            $franchise->approved = 0;
        }

        $franchise->completed = 1;

        if($franchise->save()){
            alert()->success('Franchise has been Update!')->persistent('Close');
        }

        return redirect('franchise');

    }

    /*
     * This will change the user status
     * Mainly it will toggle the status
     */
    public function change_status(Request $request){

        $franchise = Franchise::find($request->id);

        if($franchise->active){
            $franchise->active = 0;
            $msg = 'Account has been successfully disabled!';
        }else{
            $franchise->active = 1;
            $msg = 'Account has been successfully enabled!';
        }

        if($franchise->save()){
            activity()->performedOn($franchise)->withProperties($franchise->toArray())->log($franchise->active ? 'Franchise activated' : 'Franchise de-activated');
            return ['result'=> $franchise->active, 'error' => 0, 'msg' => $msg];
        }
        return ['error' => 1, 'msg' => 'Something is wrong. Try again later!'];
    }

    /*
     * Delete an user account
     */
    public function delete($id){
        if (Gate::denies('delete_franchise', Franchise::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        $franchise = Franchise::find($id);
        if($franchise->delete()){
            activity()->performedOn($franchise)->log('Franchise Deleted');
            alert()->success('Franchise account has been deleted!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function get(Request $request){
        $franchise = Franchise::select('id', 'name')->where('name', 'like', '%' . $request->term . '%')->get();

        return $franchise;
    }

    public function agents(){
        if (Gate::denies('view_my_agents', Franchise::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect('/dashboard');
        }

        $data = array();

        $franchise_id = session('franchise'); // session should have it already
        if($franchise_id){
            $franchise = Franchise::find($franchise_id);
            $agents = $franchise->agents;
        }else{
            $franchise = collect();
            $agents = collect();
        }

        $data['franchise'] = $franchise;
        $data['agents'] = $agents;

        session(['agent_url' => 'franchise/agents']);


        return view('agent::index', $data);
    }
}
