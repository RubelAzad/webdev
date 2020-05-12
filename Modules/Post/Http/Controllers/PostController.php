<?php

namespace Modules\Post\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\CargoBilling;
use Modules\Cargo\Entities\CargoDraft;
use Modules\Cargo\Entities\CargoPost;
use Modules\Cargo\Entities\CargoPostDelivery;
use Modules\Cargo\Entities\CargoPostHistory;
use Modules\Cargo\Entities\CargoPostInsurance;
use Modules\Cargo\Entities\CargoPostItem;
use Modules\Cargo\Entities\CargoPostPackage;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use Modules\Service\Entities\ServiceValuable;
use Stripe;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        return redirect('cargo');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        return view('cargo::create');
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
    public function show($tracking_no = ''){
        if( ! $tracking_no){
            alert()->error('Required parameter is missing')->persistent('Close');
            return redirect('dashboard');
        }

        $post = CargoPost::where('tracking_no', $tracking_no)->get()->first();

        if( ! $post){
            alert()->error('Incorrect Tracking Number!')->persistent('Close');
            return redirect('dashboard');
        }

        $data = array();

        $data['post'] = $post;
        $data['agent'] = $post->agent;

        if($post->payment_method == 'online'){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            try{
                $payment  = Stripe\Charge::retrieve($post->payment_reference);

            } catch (\Exception $e){
                $payment = '';
            }

        if($payment){
            $data['card_number'] = $payment->source->last4;
        }else{
            $data['card_number'] = 'Not available';
        }


        }else{
            $data['card_number'] = '';
        }



        //dd($post->statuses);


        //return view('cargo::post.index', $data);
        return view('post::index', $data);
    }

    public function get_post($tracking_no){

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(){
        return view('post::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(){

    }

    public function create_from_draft(Request $request){
        
        

        if( ! $request->draft_id){
            alert()->error('Required parameter is missing')->persistent('Close');
            return redirect('dashboard');
        }
        
        $error = false;
        $msg = '';

        $draft = CargoDraft::find($request->draft_id);
        $agent = $draft->agent;
        $service = $draft->service;

        $post = new CargoPost;
        $post->sender_id = $draft->sender_id;
        $post->sender_details = json_encode($draft->sender);
        $post->receiver_id = $draft->receiver_id;
        $post->receiver_details = json_encode($draft->receiver);
        $post->description = $draft->description;
        $post->value = $draft->value;
        $post->service_id = $draft->service->id;
        $post->unit_price = get_service_price($service->price, $service->commission, $agent);
        $post->base_price = get_service_price($service->base_price, $service->commission, $agent);
        $post->service_details = json_encode($service);

        $packages = json_decode($draft->packages);

        $post->transport_cost = get_transport_cost($packages, $draft->agent->additional_charge);

        if($draft->optionals){
            $packaging = json_decode($draft->optionals);

            $post->packaging = isset($packaging->packaging) && $packaging->packaging ? true : false;
            $post->packaging_price = isset($packaging->packaging_price) ? $packaging->packaging_price : 0;
            $post->packaging_description = isset($packaging->packaging_description) ? $packaging->packaging_description : null;

            $post->pickup_cost = isset($packaging->pickup_cost) ? $packaging->pickup_cost : 0;
            $post->discount = isset($packaging->discount) ? $packaging->discount : 0;
        }

        if($vat_applicable = get_vat_by_country_3166_3($draft->sender->country, $draft->receiver->country)){
            $post->vat = $vat_applicable;
        }

        $post->agent_id = $draft->agent_id;
        $post->user_id = auth()->id();


        $post->tracking_no = $this->generate_tracking_no($draft->sender->country);
        // process payment for this shipment

        $amount = calculate_draft_amount_total($draft->id);
        if($request->payment_method == 'online'){
            // process with stripe anf get reference number
            if($request->stripe_token){

                $online_payment = process_payment_with_stripe($request->stripe_token, $amount, $post->tracking_no);

                if($online_payment['err']){
                    $error = true;
                    $msg = 'Payment Processing Failed!';
                }else{
                    $payment_reference = $online_payment['charge_id'];
                }

            }else{
                $error = true;
                $msg = 'Payment Processing Failed!';
            }
        }else{
            $payment_reference = $request->payment_reference;
        }

        $post->payment_method = $request->payment_method;
        $post->payment_reference = $payment_reference;

        if($error){
            return ['success' => false, 'msg' => $msg ];
        }

        $post->note = $request->note;

        if($post->save()){
            // add items now
            if($draft->items){
                $items = json_decode($draft->items);
                foreach ($items as $item){

                    $valuable = ServiceValuable::find($item->id);
                    $commission_on_valuable_item = $valuable->price * $valuable->commission / 100;

                    $new_item = new CargoPostItem;
                    $new_item->valuable_item_id = $item->id;
                    $new_item->name = $item->name;
                    $new_item->value = $item->value;
                    $new_item->tax = $item->cost;
                    $new_item->original_tax = $valuable->price;
                    $new_item->commission_franchise = $commission_on_valuable_item - (($commission_on_valuable_item * $agent->commission_valuable) / 100);
                    $new_item->commission_agent = $commission_on_valuable_item - $new_item->commission_franchise;

                    $post->items()->save($new_item);
                }
            }

            if($draft->insurance){
                $insurance = json_decode($draft->insurance);
                $insurance_commission = get_settings('insurance_commission', 0);
                foreach ($insurance as $item){
                    if($item->keep){
                        $dist_ins_com = $item->cost * $insurance_commission / 100;
                        $com_franchise = $dist_ins_com * get_settings('insurance_commission_franchise', 0) / 100;
                        $com_agent = $dist_ins_com * get_settings('insurance_commission_agent', 0) / 100;

                        $post->insurances()->save(new CargoPostInsurance([
                            'item_id' => $item->id == 'x' ? 0 : $item->id,
                            'name' => $item->name,
                            'value' => $item->value,
                            'cost' => $item->cost,
                            'com_franchise' => $com_franchise,
                            'com_agent' => $com_agent
                        ]));
                    }
                }
            }


            //add packages
            $packages = json_decode($draft->packages);
            foreach ($packages as $package){
                $new_package = new CargoPostPackage;
                $new_package->package_type_id = $package->type_id;
                $new_package->quantity = $package->quantity;
                $new_package->weight = $package->weight;
                $new_package->length = $package->length ? $package->length : null;
                $new_package->width = $package->width ? $package->width : null;
                $new_package->height = $package->height ? $package->height : null;

                $post->packages()->save($new_package);
            }

            // add delivery information
            if($draft->delivery){
                $delivery = json_decode($draft->delivery);

                $post_delivery = new CargoPostDelivery;
                $post_delivery->address = isset($delivery->delivery) ? true : false;
                $post_delivery->agent_id = $delivery->agent_id;

                if(isset($delivery->delivery) && $delivery->delivery){

                    $post_delivery->receiver = $delivery->receiver ? true : false;
                    $post_delivery->name = $delivery->name;
                    $post_delivery->address_line_1 = $delivery->address_line_1;
                    $post_delivery->address_line_2 = $delivery->address_line_2;
                    $post_delivery->address_line_3 = $delivery->address_line_3;
                    $post_delivery->city = $delivery->city;
                    $post_delivery->postcode = $delivery->postcode;
                    $post_delivery->county = $delivery->county;
                    $post_delivery->country = $delivery->country;
                    $post_delivery->contact_person = $delivery->contact_person;
                    $post_delivery->phone_number = $delivery->phone_number;
                    $post_delivery->email = $delivery->email;
                    $post_delivery->instruction = $delivery->instruction;
                    $post_delivery->price = $delivery->price;

                }else{
                    $post_delivery->name = 'Agent Location';
                    $post_delivery->price = $delivery->collection_price;


                }
                $post->destination_agent_id = $delivery->agent_id;
                $post->delivery()->save($post_delivery);
                $post->save();

            }

            // add history
            $post->histories()->save( new CargoPostHistory( [ 'description' => 'Shipment has been created', 'user_id' => auth()->id() ] ) );

            // attach current billing information to the post to prevent conflict with future change
            $billing = new CargoBilling;
            $billing->base_price = $post->service->base_price;
            $billing->unit_price = $post->service->price;
            $billing->weight_commission_franchise = $post->service->commission;
            $billing->weight_commission_agent = $post->agent->commission;
            $billing->discount = $post->discount;
            $billing->transport_cost = $post->transport_cost;
            $billing->location_charge = $post->agent->location_charge;
            $billing->vat = $post->vat;

            $post->billing()->save($billing);

            // send notification to sender
            // send notification to receiver

            //alert()->success( 'Shipment has been created!', strtoupper($post->tracking_no))->persistent('Close');

            // delete the draft
            if(env('production', 1)){
                $draft->delete();
            }

            return ['success' => true, 'tracking_number' => $post->tracking_no];
        }

        //alert()->error('Something went wrong! Please try again from draft!')->persistent('Close');

        return ['success' => false, 'msg' => $msg ];

    }

    public function get_insurance_price_from_draft_items($items){
        $price = 0;

        foreach ($items as $item){
            if( $item->keep){
                $price = $price + $item->cost;
            }
        }

        return $price;
    }

    public function generate_tracking_no($country_code){
        $tracking_no = $country_code . time();

        $post = CargoPost::where('tracking_no', '=', $tracking_no)->get()->first();

        if($post){
            // if this tracking no already exist, generate again
            return $this->generate_tracking_no($country_code) + 1;
        }

        return $tracking_no;
    }

    public function invoice($id = ''){
        if(! $id){
            flash('Required parameter is missing!')->important();
            return redirect()->back();
        }
        $data = array();

        $post = CargoPost::find($id);

        $agent = $post->agent;

        $data['post'] = $post;
        $data['agent'] = $agent;

        if($agent->logo_id){
            $logo_content = file_get_contents(url('file/serve/' . $agent->logo->hash));
        }else{
            $logo_content = file_get_contents(base_path('public/img/logo.png'));
        }

        $data['logo'] = 'data:image/png;base64,' . base64_encode($logo_content);

        $options = array(
            'footer-line' => true,
            'margin-bottom' => 20,
            'footer-left' => get_settings('powered_by', 'Powered By: Magic Office Limited'),
            'footer-center' => '',
            'footer-right' => 'Page [page] of [topage]',
            'footer-spacing' => 8,
            'footer-font-size' => 8
        );

        return view('cargo::invoice', $data);
        return SnappyPdf::loadView('cargo::invoice', $data)->setOptions($options)->inline('invoice.pdf');
    }

    public function label($id = ''){
        if(! $id){
            flash('Required parameter is missing!')->important();
            return redirect()->back();
        }
        $data = array();

        $post = CargoPost::find($id);

        $agent = $post->agent;

        $data['post'] = $post;
        $data['agent'] = $agent;

        if($agent->logo_id){
            $logo_content = file_get_contents(url('file/serve/' . $agent->logo->hash));
        }else{
            $logo_content = file_get_contents(base_path('public/img/logo.png'));
        }

        $data['logo'] = 'data:image/png;base64,' . base64_encode($logo_content);

        $barcode = new BarcodeGenerator();
        $barcode->setText($post->tracking_no);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        $barcode = 'data:image/png;base64,'.$code;
        $data['barcode'] = $barcode;



        $qrCode = new QrCode();
        $qrCode->setText($post->tracking_no);
        $qrCode->setSize(200);
        $qrCode->setPadding(10);
        $qrCode->setErrorCorrection('high');
        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
        $qrCode->setLabel('Scan Qr Code');
        $qrCode->setLabelFontSize(16);
        $qrCode = 'data:image/png;base64,'.$qrCode->generate();
        $data['qrCode'] = $qrCode;


        return view('cargo::label', $data);
        return SnappyPdf::loadView('cargo::label', $data)->setOrientation('landscape')->inline('label.pdf');
    }

    public function cancel_post($tracking_no = ''){
        if(! $tracking_no){
            flash('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $post = CargoPost::where('tracking_no', '=', $tracking_no)->get()->first();

        if (Gate::denies('cancel_shipment', $post)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if($post->delete()){
            // TODO:: Notify to the sender

            alert()->success('Shipment has been canceled!')->persistent('Close');
        }

        return redirect()->back();
    }
}