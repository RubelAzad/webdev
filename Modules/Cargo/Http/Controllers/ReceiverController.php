<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\CargoDraft;
use Modules\Cargo\Entities\CargoReceiver;

class ReceiverController extends Controller
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

        if($request->receiver_id){
            $receiver = CargoReceiver::find($request->receiver_id);
        }else{
            $receiver = new CargoReceiver;
        }

        if($request->has('sender_id')){
            $receiver->sender_id = $request->sender_id;
        }

        $receiver->name = $request->receiver_account;
        $receiver->address_line_1 = $request->receiver_address_line_1;
        $receiver->address_line_2 = $request->receiver_address_line_2;
        $receiver->address_line_3 = $request->receiver_address_line_3;
        $receiver->city = $request->receiver_city;
        $receiver->county = $request->receiver_county;
        $receiver->postcode = $request->receiver_postcode;
        $receiver->country = $request->receiver_country;
        $receiver->contact_person = $request->receiver_contact_person;
        $receiver->phone_number = $request->receiver_phone_number;
        $receiver->email = $request->receiver_email;


        if($receiver->save()){

            if($request->has('draft_id')){
                $draft = CargoDraft::find($request->draft_id);
                $draft->receiver_id = $receiver->id;
                $draft->save();

                if($draft->delivery && count(json_decode($draft->delivery, true)) > 5){
                    return json_decode($draft->delivery, true);
                }
            }

            return $receiver;
        }

    }

    public function select_receiver(Request $request){
        $receiver = CargoReceiver::find($request->receiver_id);
        return $receiver;
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
    public function edit()
    {
        return view('cargo::edit');
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
