<?php

namespace Modules\Cargo\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Agent\Entities\Agent;
use Modules\Cargo\Entities\CargoDraft;
use Modules\Cargo\Entities\CargoSender;

class SenderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cargo::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cargo::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request){

        $data = array();

        if($request->sender_id){
            $sender = CargoSender::find($request->sender_id);
        }else{
            $sender = new CargoSender;
            $sender->agent_id = session('agent', null); // get the agent_id from session
        }

        $sender->name = $request->sender_account;
        $sender->address_line_1 = $request->sender_address_line_1;
        $sender->address_line_2 = $request->sender_address_line_2;
        $sender->address_line_3 = $request->sender_address_line_3;
        $sender->city = $request->sender_city;
        $sender->county = $request->sender_county;
        $sender->postcode = $request->sender_postcode;
        // sender country must be same as agent country
        $agent = Agent::find(session('agent'));
        $sender->country = $agent->country; //$request->sender_country;
        $sender->contact_person = $request->sender_contact_person;
        $sender->phone_number = $request->sender_phone_number;
        $sender->email = $request->sender_email;


        if($sender->save()){

            $data['sender'] = $sender;

            // if there is email address, create an user account
            if($sender->email){

                // check if this sender has already an user account
                $user = User::where('email', $sender->email)->withTrashed()->get()->first();

                if($user->trashed()){
                    $user->restore();
                }

                if( ! $user){
                    $user = new User;
                    $user->name = $sender->name;
                    $user->email = $sender->email;
                    $user->phone_number = $sender->phone_number;
                    $user->active = 1;
                    $user->verify_token = md5(time());
                    $user->password = bcrypt('123456');
                    $user->save();

                    $sender->user_id = $user->id;
                    $sender->save();
                }
            }

            // need to save as draft now, if the request has came from draft
            if($request->has('draft_id')){
                if($request->draft_id){
                    // draft is already there; update the sender
                    $draft = CargoDraft::find($request->draft_id);
                }else{
                    // create new draft
                    $draft = new CargoDraft;
                }
                $draft->agent_id = session('agent', null); // get the agent_id from session
                $draft->sender_id = $sender->id;
                $draft->user_id = auth()->id();
                $draft->save();

                $data['receiver_table'] = view('cargo::shipment.receiver-table', ['receivers' => $sender->receivers])->render();
                $data['draft_id'] = $draft->id;
            }

        }


        return $data;
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('cargo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(){
        return view('cargo::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){}

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(){}

    public function select_sender(Request $request){
        $sender = CargoSender::find($request->sender_id);
        return $sender;
    }
}
