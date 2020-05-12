<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Gate;
use Modules\Agent\Entities\Agent;
use Modules\Agent\Entities\AgentAccount;
use Modules\Cargo\Entities\CargoAdditionalService;
use Modules\Cargo\Entities\CargoDraft;
use Modules\Cargo\Entities\CargoPackageType;
use Modules\Cargo\Entities\CargoPickup;
use Modules\Cargo\Entities\CargoPost;
use Modules\Cargo\Entities\CargoPostHistory;
use Modules\Cargo\Entities\CargoPostStatus;
use Modules\Cargo\Entities\CargoSender;
use Modules\Cargo\Notifications\CargoPostConfirmed;
use Modules\Franchise\Entities\Franchise;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\ServiceValuable;
use Modules\Warehouse\Entities\Warehouse;
use GoogleMaps;
use Carbon\Carbon;
use DHL\Client\Web;
use DHL\Datatype\AM\PieceType;
use DHL\Entity\AM\GetQuote;
use Barryvdh\Snappy\Facades\SnappyPdf;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        $data = array();

        if(session('agent')){
            // load all un-delivered posts belongs to this agent
            $agent = Agent::find(session('agent'));
            $posts = $agent->posts()->where('status_id', '>', 0)->where('status_id', '<', 8)->get();
        }elseif(session('franchise')){
            // load all un-delivered posts belongs to this franchise
            $franchise = Franchise::find(session('franchise'));
            $posts = CargoPost::current()->whereIn('agent_id', $franchise->agents->pluck('id'))->get();
        }else{
            // load all un-delivered posts
            $posts = CargoPost::current()->get();
        }

        $data['posts'] = $posts;
        return view('cargo::index', $data);
    }

    public function get_quote(){
        $data = array();

        $agent = '';

        if(session('agent')){
            $agent = Agent::find(session('agent'));
        }else{
            flash()->info('Please login as an agent to get quote')->important();
            return redirect('home');
        }

        $data['agent'] = $agent;


        $package_types = CargoPackageType::active()->get();
        $data['package_types'] = $package_types;
        $data['services'] = [];
        $data['quantity'] = '';

        //$countries = new Countries();
        //dd($countries->where('cca3', 'GBR')->first());

//        $response = GoogleMaps::load('geocoding')
//            ->setParam([
//                'address' => '11000',
//                'components' => ['country' => 'FR']
//            ])
//            ->get();
//
//        return json_decode($response, true);

//        $url = 'https://ezcmd.com/apps/api_geo_postal_codes/search/f57939e47408519e215a4d278e6ad3d9/273?zip_query=1214, BD';
//        $result = file_get_contents($url);
//
//        dd($result);

        session(['valuable_items' => collect()]);

        $data['valuable_items'] = collect();

        return view('cargo::quote.index', $data);
    }

    public function get_quote_from_providers(Request $request){
        //return $request->input();

        $src = $request->src_country_code;
        $dst = $request->to_country_code;

        $total_weight = 0;

        $packages = get_packages_to_get_quote($request);

        foreach ($packages as $package){
            $lwh_t=(($package->length * $package->width * $package->height)/get_settings('mass_divider', 5000));
            $lwh_wd = $package->weight;
            if( $lwh_wd < $lwh_t){
                $total_weight = $total_weight + $lwh_t;
            }else{
                $total_weight = $total_weight + $lwh_wd;
            }

        }

        $data['quantity'] = $total_weight;


        $agent = Agent::find(session('agent'));
        $package_types = CargoPackageType::active()->get();
        $data['package_types'] = $package_types;

        $data['agent'] = $agent;

        $services = Service::where('src_country', $src)
            ->where('dst_country',  $dst)
            ->where('maximum_weight', '>=', $total_weight)
            ->where('minimum_weight', '<=', $total_weight)
            ->get();

        $data['services'] = $services;
        $valuable_items = session('valuable_items');
        $data['valuable_items'] = $valuable_items;

        $data['declare_value'] = $request->declare_value;
        $insurance_rate = get_settings('insurance');
        $data['insurance_rate'] = $insurance_rate;

        $insurance_all = 0;

        $insurance = false;


        if($request->has('insurance')){

            $insurance = true;

            if($request->has('cover_all')){
                $insurance_all = $request->declare_value * $insurance_rate / 100;
            }


        }


        $data['insurance'] = $insurance;
        $data['insurance_all'] = $insurance_all;

        return view('cargo::quote.result', $data);
    }

    public function get_quote_from_all(Request $request){
        //return $request->input();

        $src_country = get_country_by_iso_3166_2($request->src_country_code);
        $to_country = get_country_by_iso_3166_2($request->to_country_code);

        $quote = new GetQuote();
        $quote->SiteID = config('dhl.id');
        $quote->Password = config('dhl.pass');

        // Set values of the request
        $quote->MessageTime = Carbon::now()->format('Y-m-d') .'T'. Carbon::now()->format('H:i:s');//'2018-12-01T09:30:47-05:00';//;
        $quote->MessageReference = 'NEC-Cargo-123456789-123456789';
        $quote->BkgDetails->Date = Carbon::now()->format('Y-m-d');

        // find package information from inputs
        $packages = collect();
        $inputs = $request->input();
        foreach ($inputs as $input => $value){
            if(starts_with($input, 'row')){
                $packages->put($input, $value);
            }
        }

        $packages =  $packages->chunk(5);

        // add packages to search quote
        $i = 1;
        foreach ($packages as $package){
            $type = 'row-'.$i.'-package_type';
            $weight = 'row-'.$i.'-weight';
            $height = 'row-'.$i.'-height';
            $length = 'row-'.$i.'-length';
            $width = 'row-'.$i.'-width';

            //dd($package[$type]);

            $piece = new PieceType();
            $piece->PieceID = $i;
            $piece->Height = $package[$height];
            $piece->Depth = $package[$length];
            $piece->Width = $package[$width];
            $piece->Weight = $package[$weight];

            $quote->BkgDetails->addPiece($piece);

            $i = $i+1;
        }

        //return $packages;

        $quote->BkgDetails->IsDutiable = 'Y';
        $quote->BkgDetails->ReadyTime = 'PT10H21M';
        $quote->BkgDetails->ReadyTimeGMTOffset = '+01:00';
        $quote->BkgDetails->DimensionUnit = 'CM';
        $quote->BkgDetails->WeightUnit = 'KG';
        $quote->BkgDetails->PaymentCountryCode = $request->src_country_code;
        $quote->BkgDetails->IsDutiable = 'Y';

        // Request Paperless trade
        $quote->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';

        $quote->From->CountryCode = $request->src_country_code;
        $quote->From->Postalcode = $request->src_postcode;
        $quote->From->City = $request->src_city;

        $quote->To->CountryCode = $request->to_country_code;
        $quote->To->Postalcode = $request->to_postcode;
        $quote->To->City = $request->to_city;
        $quote->Dutiable->DeclaredValue = '00';
        $quote->Dutiable->DeclaredCurrency = $to_country->currency_code;

        // Call DHL XML API
        //$start = microtime(true);
        //echo $quote->toXML();
        //dd($quote->toXML());
        $client = new Web('staging');
        $xml = $client->call($quote);
        //echo PHP_EOL . 'Executed in ' . (microtime(true) - $start) . ' seconds.' . PHP_EOL;
        //echo $xml . PHP_EOL;
        //dd($xml);
        $xml = simplexml_load_string($xml);
        $json = json_encode($xml);
        $result = json_decode($json);

        //dd($result);

        $prices = $result->GetQuoteResponse->BkgDetails->QtdShp;
        //dump($piece);
//        foreach ($prices as $price){
//            dump($price);
//        }
        //dd($array['GetQuoteResponse']);

        $data = array();
        $package_types = CargoPackageType::active()->get();
        $data['package_types'] = $package_types;
        $data['prices'] = $prices;

        return view('cargo::quote.index', $data);
    }



    public function get_line_for_quote( $i = 1){
        $data = array();
        $package_types = CargoPackageType::active()->get();
        $data['package_types'] = $package_types;
        $data['i'] = $i + 1;

        return ['i' => $i + 1, 'row' => view('cargo::quote.package-fields', $data)->render()];
    }

    public function add_item_to_quote(Request $request){

        $valuable_items = session('valuable_items');

        if( ! $valuable_items){
            $valuable_items = collect();
        }

        $item = collect();
        $valuable = ServiceValuable::find($request->item_id);
        $item->put('id', $request->item_id);
        $item->put('name', $valuable->name);
        $item->put('cost', $request->item_cost);
        $item->put('value', $request->item_value);

        $valuable_items->push($item);

        session(['valuable_items' => $valuable_items]);

        return ['items' => view('cargo::quote.items-row', ['items' => collect()->push($item)])->render()];

    }

    public function draft(){
        $data = array();
        $agent_id = session('agent', null);
        $drafts = collect();
        if($agent_id){
            $drafts = CargoDraft::where('agent_id', $agent_id)->get();
        }

        $data['drafts'] = $drafts;
        return view('cargo::draft', $data);
    }

    public function delete_draft($id = 0){
        if($id){
            $draft = CargoDraft::find($id);

            if($draft){
                if($draft->delete()){
                    flash()->success('Draft has been deleted!')->important();
                }
            }
        }

        return redirect()->back();
    }

    public function print_draft($id){
        $data = array();

        $draft = CargoDraft::find($id);
        $agent = Agent::find(session('agent'));

        $data['draft'] = $draft;
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
            'footer-left' => 'Powered by: ' . env('ORG', 'Magic Office'),
            'footer-center' => '',
            'footer-right' => 'Page [page] of [topage]',
            'footer-spacing' => 8,
            'footer-font-size' => 8
        );

        //return view('cargo::print-draft', $data);
        return SnappyPdf::loadView('cargo::print-draft', $data)->setOptions($options)->inline('invoice.pdf');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id = 0){
        if (Gate::denies('create_shipment', CargoPost::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $agent = Agent::find(session('agent'));
        $data = array();
        $package_types = CargoPackageType::active()->get();
        $data['package_types'] = $package_types;
        $data['senders'] = CargoSender::where('agent_id', $agent->id)->get();

        $data['services'] = CargoAdditionalService::active()->get();

        if($id){
            $draft = CargoDraft::find($id);
        }else{
            $draft = '';
        }

        //return get_countries_by_src_for_select($agent->country);

        $data['agent'] = $agent;

        $data['draft'] = $draft;
        return view('cargo::shipment.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request){
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(){
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
    public function update(Request $request){
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(){
    }

    public function track(){

        return view('cargo::track');
    }

    public function import(){

        return view('cargo::import.index');
    }

    public function update_description(Request $request){
        $draft = CargoDraft::find($request->draft_id);
        $draft->description = $request->description;

        $draft->save();

        return $draft->description;
    }

    public function update_declare_value(Request $request){
        $draft = CargoDraft::find($request->draft_id);
        $draft->value = $request->declare_value;

        $draft->save();

        return $draft->value;
    }


    public function add_package(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $package_type = CargoPackageType::find($request->type);

        if($package_type->code == 'DOC'){
            $draft->doc = 1;
        }else{
            $draft->doc = 0;
        }

        $package = array();
        $package['type_id'] = $package_type->id;
        $package['type_name'] = $package_type->name;
        $package['quantity'] = $request->quantity;
        $package['weight'] = $request->weight;

        if($request->has('length')){
            $package['length'] = $request->length;
        }else{
            $package['length'] = '';
        }

        if($request->has('width')){
            $package['width'] = $request->width;
        }else{
            $package['width'] = '';
        }

        if($request->has('height')){
            $package['height'] = $request->height;
        }else{
            $package['height'] = '';
        }

        $packages = array();
        $packages[]= $package;

        if( $draft->packages ){
            $current_packages = json_decode($draft->packages);
            $current_packages[] = $package;
            $draft->packages = json_encode($current_packages);
        }else{
            $draft->packages = json_encode($packages);
        }

        $draft->save();

        return array(
            'rows' => count(json_decode($draft->packages)),
            'code' => $package_type->code,
            'table' => view('cargo::shipment.package-table', ['packages' => $draft ? json_decode($draft->packages) : '', 'draft_id' => $draft ? $draft->id :''])->render()
        );
    }

    public function remove_package($draft_id, $row_id){

        $draft = CargoDraft::find($draft_id);

        $current_packages = json_decode($draft->packages);
        $new_packages = array();
        $i = 1;
        foreach ($current_packages as $package){
            if( $i++ != $row_id){
                $new_packages[] = $package;
            }
        }

        $draft->packages = count($new_packages) ? json_encode($new_packages) : null;
        $draft->save();

        return array(
            'rows' => count($new_packages),
            'table' => view('cargo::shipment.package-table', ['packages' => $draft ? json_decode($draft->packages) : '', 'draft_id' => $draft ? $draft->id :''])->render()
        );
    }

    public function add_declarable(Request $request){
        $draft = CargoDraft::find($request->draft_id);

        // check if the total value crossing the total declare value
//        if( $draft->items ){
//            $current_items = json_decode($draft->items);
//
//            if(count($current_items)){
//                $current_value = array_sum(array_pluck($current_items, 'value'));
//
//                if($draft->value < ($current_value + $request->d_item_value)){
//                    return ['error' => 'The total value of declare items must not be grater then total declare value ('.$draft->value.')!'];
//                }
//            }else{
//                return ['error' => 'The total value of declare items must not be grater then total declare value ('.$draft->value.')!'];
//            }
//
//        }else{
//            if($draft->value < $request->valuable_item_value){
//                return ['error' => 'The total value of declare items must not be grater then total declare value ('.$draft->value.')!'];
//            }
//        }

        $valuable = ServiceValuable::find($request->valuable_item_id);


        $item = array();
        $item['id'] = $valuable->id;
        $item['name'] = $valuable->name;
        $item['value'] = $request->valuable_item_value;
        $item['cost'] = $request->valuable_item_cost;

        $items = array();
        $items[]= $item;

        if( $draft->items ){
            $current_items = json_decode($draft->items);
            $current_items[] = $item;
            $draft->items = json_encode($current_items);
        }else{
            $draft->items = json_encode($items);
        }

        $draft->save();

        return array(
            'total_value' => array_sum(array_pluck(json_decode($draft->items), 'value')),
            'table' => view('cargo::shipment.declarable-table', ['items' => $draft->items ? json_decode($draft->items) : '', 'draft_id' => $draft->id])->render()
        );
    }

    public function remove_declarable($draft_id, $row_id){

        $draft = CargoDraft::find($draft_id);

        $current_items = json_decode($draft->items);
        $new_items = array();
        $i = 1;
        foreach ($current_items as $item){
            if( $i++ != $row_id){
                $new_items[] = $item;
            }
        }

        $draft->items = json_encode($new_items);
        $draft->save();

        return array(
            'total_value' => array_sum(array_pluck(json_decode($draft->items), 'value')),
            'table' => view('cargo::shipment.declarable-table', ['items' => $draft->items ? json_decode($draft->items) : '', 'draft_id' => $draft->id])->render()
        );
    }

    public function get_services(Request $request){
        $draft = CargoDraft::find($request->draft_id);

        $src = $draft->sender->country;
        $dst = $draft->receiver->country;
        $packages = json_decode($draft->packages);
        $total_weight = 0;
        $lwh_wdall = 0;
        $total_quant=0;
        // calculate total weight
        foreach ($packages as $package){
            //$lwh_wd1 = $package->weight;
            $lwh_t=(($package->length * $package->width * $package->height)/get_settings('mass_divider', 5000));
            $lwh_wd = $package->weight;
            $quant = $package->quantity;
            $total_quant =$total_quant + $quant;
            $lwh_wdall = $lwh_wdall + $lwh_wd;
            if( $lwh_wd < $lwh_t){
                $total_weight = $total_weight + $lwh_t;
            }else{
                $total_weight = $total_weight + $lwh_wd;
            }

        }

        $agent = Agent::find(session('agent'));



        //$services = CargoServiceItem::where('src_country', '=', $src)->where('dst_country', '=', $dst)->get();
        /* $services = Service::where('src_country', $src)
            ->where('dst_country',  $dst)
            ->where('maximum_weight', '>=', $total_weight)
            ->where('minimum_weight', '<=', $total_weight)
            ->join('cuscommissions', 'cuscommissions.chargesetup', '=', 'services.name')
            ->get();
 */
        $services = Service::join('cuscommissions', 'cuscommissions.chargesetup', '=', 'services.name')
                    ->select('cuscommissions.*','services.*')
                    ->where('cuscommissions.franchise_id','=',$agent->id)
                    ->where('maximum_weight', '>=', $total_weight)
                    ->where('minimum_weight', '<=', $total_weight)
                    ->get();

        return array(
            'services' => view('cargo::shipment.services-table', [
                'agent' => $agent,
                'services' => $services,
                'quantity' => $total_weight,
                'weight' => $lwh_wdall,
                'p_qualt' => $total_quant
            ])->render()
        );
    }

    public function select_service(Request $request){


        $draft = CargoDraft::find($request->draft_id);
        $service = Service::find($request->service_selected);
        //$service_item = CargoServiceItem::find($request->service_selected);
        $draft->service_id = $service->id;
        $draft->save();

        $packages = json_decode($draft->packages);

        $total_weight = get_total_weight($packages);

        $agent = Agent::find(session('agent'));
        $price = get_service_price($service->price, $service->commission, $agent);
        $total_price = get_service_price_total($service->base_price, $price, $service->commission, $total_weight, $agent);

        return array(
            'provider' => $service->provider->name,
            'name' => $service->name,
            'info' => $service->speed,
            'total' => $total_price
        );
    }

    public function get_valuable_items_src_dts(Request $request){

        $src = $request->src ? $request->src : '';
        $dst = $request->dst ? $request->dst : '';


        if($request->has('draft_id')){
            $draft_id = $request->draft_id;


            $draft = CargoDraft::find($draft_id);
            $src = $draft->sender->country;
            $dst = $draft->receiver->country;

        }


        $data = ['src' => $src, 'dst' => $dst];

        return ['options' => view('cargo::shipment.select-valuable-items', $data)->render()];
    }

    public function add_pickup_charge(Request $request){
        $draft = CargoDraft::find($request->draft_id);

        $packaging = json_decode($draft->optionals);

        data_set($packaging, 'pickup_cost', $request->cost);

        $draft->optionals = json_encode($packaging);

        if($draft->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

//    public function get_insurance(Request $request){
//        $draft = CargoDraft::find($request->draft_id);
//
//        $items = json_decode($draft->items);
//
//        return view('cargo::shipment.insurance-table', [ 'items' => $items, 'draft_id' => $draft->id ]);
//    }
//    public function get_insurance_all(Request $request){
//        $draft = CargoDraft::find($request->draft_id);
//
//        $insurance = '';
//        if($draft){
//            if( $draft->insurance ){
//                $insurance = json_decode($draft->insurance);
//            }
//        }
//
//        return view('cargo::shipment.insurance-all', [ 'draft' => $draft, 'insurance' => $insurance]);
//    }

    public function add_delivery(Request $request){

        $draft = CargoDraft::find($request->draft_id);
        $delivery = array();
        if($draft->delivery){
            $delivery = json_decode($draft->delivery);
        }
        data_set($delivery, 'delivery', $request->delivery);

        $draft->delivery = json_encode($delivery);

        $draft->save();

        return json_decode($draft->delivery, true);
    }

    public function update_delivery(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $receiver = $draft->receiver;

        $delivery = json_decode($draft->delivery, true);
        if($request->has('delivery_to_receiver')){
            // delivery to receiver address
            $delivery['receiver'] = true;
            $delivery['name'] = $receiver->name;
            $delivery['address_line_1'] = $receiver->address_line_1;
            $delivery['address_line_2'] = $receiver->address_line_2;
            $delivery['address_line_3'] = $receiver->address_line_3;
            $delivery['city'] = $receiver->city;
            $delivery['county'] = $receiver->county;
            $delivery['postcode'] = $receiver->postcode;
            $delivery['country'] = $receiver->country;
            $delivery['contact_person'] = $receiver->contact_person;
            $delivery['phone_number'] = $receiver->phone_number;
            $delivery['email'] = $receiver->email;
        }else{
            // delivery to different address
            $delivery['receiver'] = false;
            $delivery['name'] = $request->delivery_account;
            $delivery['address_line_1'] = $request->delivery_address_line_1;
            $delivery['address_line_2'] = $request->delivery_address_line_2;
            $delivery['address_line_3'] = $request->delivery_address_line_3;
            $delivery['city'] = $request->delivery_city;
            $delivery['county'] = $request->delivery_county;
            $delivery['postcode'] = $request->delivery_postcode;
            $delivery['country'] = $request->delivery_country;
            $delivery['contact_person'] = $request->delivery_contact_person;
            $delivery['phone_number'] = $request->delivery_phone_number;
            $delivery['email'] = $request->delivery_email;
        }

        $delivery['agent_id'] = $request->delivery_agent_id;
        $delivery['instruction'] = $request->delivery_instruction;
        $delivery['price'] = $request->delivery_price;

        $draft->delivery = json_encode($delivery);

        if($draft->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

    public function update_collection_point(Request $request){

        //return $request->input();

        $draft = CargoDraft::find($request->draft_id);

        $delivery = json_decode($draft->delivery, true);

        $delivery['collection_price'] = $request->collection_price;
        $delivery['agent_id'] = $request->agent_id;

        $draft->delivery = json_encode($delivery);

        if($draft->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

    public function add_insurance(Request $request){
        $draft = CargoDraft::find($request->draft_id);

        if($request->insurance){
            $insurance = array();

            $insurance[] = ['id' => 'x', 'name' => 'General goods', 'value' => $draft->value, 'cost' => $draft->value * get_settings('insurance') / 100, 'max' => $draft->value * get_settings('max_insurance')/100, 'keep' => true];

            if($draft->items){
                $items = json_decode($draft->items);
                foreach ($items as $item){
                    $insurance[] = [
                        'id' => $item->id,
                        'name' => $item->name,
                        'value' => $item->value,
                        'cost' => $item->value * get_settings('insurance') / 100,
                        'max' => $item->value * get_settings('max_insurance')/100,
                        'keep' => true
                    ];
                }
            }

            $draft->insurance = json_encode($insurance);

        }else{
            $draft->insurance = false;
        }

        $draft->save();

        return [
            'insurance' => $draft->insurance ? true : false,
            'insurance_table' => view('cargo::shipment.insurance-table', ['items' => json_decode($draft->insurance), 'draft_id' => $draft->id ])->render()
        ];
    }

    public function update_insurance(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $items = json_decode($draft->insurance);

        foreach ($items as $item){
            if($item->id == $request->item_id){
                $item->keep = $request->keep;
            }
        }

        $draft->insurance = json_encode($items);

        if($draft->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

    public function add_additional_packaging(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $packaging = array();
        if($draft->optionals){
            $packaging = json_decode($draft->optionals);
        }
        //$insurance->insurance
        data_set($packaging, 'packaging', $request->additional_packaging);

        $draft->optionals = json_encode($packaging);

        $draft->save();

        return json_decode($draft->optionals, true);
    }

    public function update_additional_packaging(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $packaging = json_decode($draft->optionals);

        data_set($packaging, 'packaging_price', $request->additional_packaging_price);
        data_set($packaging, 'packaging_description', $request->additional_packaging_description);

        $draft->optionals = json_encode($packaging);

        if($draft->save()){
            return ['success' => true];
        }

        return ['error' => true];
    }

    public function get_summary($draft_id = ''){
        $draft = CargoDraft::find($draft_id);
        $agent = Agent::find(session('agent'));
        return view('cargo::shipment.summary', [ 'draft' => $draft, 'agent' => $agent, 'service' => $draft->service ]);
    }

    public function get_agents_for_receiver(Request $request){
        $draft = CargoDraft::find($request->draft_id);

        // get agent according to receiver country
        $agents = get_agents_by_country($draft->receiver->country);

        $data = [];

        // attach cost according to zone
        foreach ($agents as $agent){
            $data[] = [
                'id' => $agent->id,
                'name' => $agent->name,
                'address_line_1' => $agent->address_line_1,
                'city' => $agent->city,
                'collection_cost' => $agent->zone->collection,
                'delivery_cost' => $agent->zone->delivery
            ];
        }

        return $data;
    }

    public function get_post_basic_info(Request $request){
        $posts = CargoPost::whereIn('tracking_no', $request->posts)->get();

        $agent_id = session('agent');
        $agent = Agent::find($agent_id);

        $current_balance = $agent->payments->sum('amount') - $agent->accounts->sum('amount');
        $available_credit = $agent->credit + $current_balance;

        $total_cost = 0;

        $packages = [];
        foreach ($posts as $post){
            // if payment method is online, means it is paid already
            if($post->payment_method != 'online'){
                $total_cost = $total_cost + get_post_total_for_agent_billing($post);
                foreach ($post->packages as $package){

                    if( isset($packages[$package->package_type_id]) ){
                        $new_package = $packages[$package->package_type_id];
                        $new_package['quantity'] = $new_package['quantity'] + $package->quantity;
                        $new_package['weight'] = $new_package['weight'] + $package->weight;
                    }else{
                        $new_package['name'] = $package->type->name;
                        $new_package['quantity'] = $package->quantity;
                        $new_package['weight'] = $package->weight;
                    }

                    $packages[$package->package_type_id] = $new_package;
                }
            }
        }

        $allow_to_submit = $available_credit - $total_cost >=0 ? true : false;

        return [
            'allow_to_submit' => $allow_to_submit,
            'info' => view('cargo::basic-info', [
                'agent' => $agent,
                'packages' => $packages,
                'total_cost' => $total_cost,
                'available_credit' => $available_credit,
                'allow_to_submit' => $allow_to_submit,
            ])->render()
        ];

    }

    public function update_discount(Request $request){

        $draft = CargoDraft::find($request->draft_id);

        $packaging = array();
        if($draft->optionals){
            $packaging = json_decode($draft->optionals);
        }

        data_set($packaging, 'discount', $request->discount);

        $draft->optionals = json_encode($packaging);

        $draft->save();

        return json_decode($draft->optionals, true);
    }

    public function pickup_booking(){
        $data = array();

        if (Gate::denies('pickup_booking_warehouse', CargoPost::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $agent_id = session('agent', null);

        $agent = Agent::find($agent_id);
        $data['agent'] = $agent;

        $current_balance = $agent->payments->sum('amount') - $agent->accounts->sum('amount');
        $data['current_balance'] = $current_balance;

        $data['available_credit'] = $agent->credit + $current_balance;
        $posts = $agent->posts()->where('status_id', 0)->get(); // 0 = to be confirm, currently no status

        $data['posts'] = $posts;
        return view('cargo::to-b-confirmed', $data);
    }

    public function submit_for_pickup(Request $request){

        $posts = CargoPost::whereIn('tracking_no', $request->posts)->get();

        $agent = Agent::find(session('agent'));
        $balance = $agent->accounts->sum('amount') - $agent->payments->sum('amount');
        $available_limit = $agent->credit - $balance;

        $total_cost = 0;
        $available_credit = $available_limit;

        if($available_credit > 0){
            // check the status of the post
            foreach ($posts as $post){
                // if this post wasn't processed already
                if( ! $post->status ){
                    // if payment method is online, means it's paid already
                    if($post->payment_method != 'online'){
                        $cost = get_post_total_for_agent_billing($post);
                        $total_cost = $total_cost + $cost;
                    }
                }
            }


            // if total cost of this selection is still less then available credit
            if($available_credit >= $total_cost){
                foreach ($posts as $post){

                    // if this post wasn't processed already
                    if( ! $post->status ){
                        // no status has been assigned

                        $status_id = get_status_id_by_code('confirmed');

                        if($this->update_post_status($post, $status_id)){

                            $cost = 0;

                            //if payment method is online, means it's paid already
                            if($post->payment_method != 'online'){
                                // this is not paid, so count the cost
                                $cost = $cost + get_post_total_for_agent_billing($post);

                                // add entry to the account table
                                $credit = new AgentAccount;
                                $credit->date = Carbon::now();
                                $credit->amount = $cost;
                                $credit->post_id = $post->id;
                                $credit->description = 'Shipment tracking no: ' . $post->tracking_no;
                                $credit->user_id = auth()->id();
                                $agent->accounts()->save($credit);
                            }

                            // update balance and available credit
                            $agent->balance = $agent->balance + $cost;
                            $agent->save();

                            // Add to pickup booking request
                            $pickup = new CargoPickup;
                            $pickup->date = Carbon::now();
                            $pickup->agent_id = $post->agent_id;
                            $pickup->user_id = auth()->id();
                            $post->pickup_request()->save($pickup);

                            //send notification for head office
                            $post->notify(new CargoPostConfirmed( $post ));
                        }
                    }
                }
            }else{
                return ['status' => false, 'msg' => 'Can not process your request, insufficient credit!'];
            }
        }else{
            return ['status' => false, 'msg' => 'Can not process your request, insufficient credit!'];
        }

        return ['status' => true];

    }


    public function update_post_status(CargoPost $post, $status_id){
        $post->status_id = $status_id;

        if($post->save()){
            $post->statuses()->save(new CargoPostStatus(['status_id' => $status_id]));

            $post->histories()->save(new CargoPostHistory([
                'description' => 'Shipment has been confirmed from the agent location',
                'user_id' => auth()->id()
            ]));

            return true;
        }

        return false;
    }

    public function confirmed_booking($agent_id = ''){
        $data = array();

        if (Gate::denies('view_confirmed_booking_list', CargoPost::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $pickups = CargoPickup::not_picked()->get();

        if($agent_id){
            $agent = Agent::find($agent_id);
            $pickups = $pickups->where('agent_id', '=', $agent_id);
            $data['pickups'] = $pickups;
            $data['agent'] = $agent;
            $view = 'cargo::confirmed-booking-agent';
        }else{
            $agents = $pickups->groupBy('agent_id');
            $data['agents'] = $agents;
            $view = 'cargo::confirmed-booking';
        }

        return view($view, $data);
    }


    public function assign_warehouse_pickup(Request $request){
        $posts = CargoPost::whereIn('tracking_no', explode(',', $request->posts))->get();
        $warehouses = Warehouse::all();

        $data = array();

        $data['posts'] = $posts;
        $data['warehouses'] = $warehouses;

        $packages = [];
        foreach ($posts as $post){
            foreach ($post->packages as $package){

                if( isset($packages[$package->package_type_id]) ){
                    $new_package = $packages[$package->package_type_id];
                    $new_package['quantity'] = $new_package['quantity'] + $package->quantity;
                    $new_package['weight'] = $new_package['weight'] + $package->weight;
                }else{
                    $new_package['name'] = $package->type->name;
                    $new_package['quantity'] = $package->quantity;
                    $new_package['weight'] = $package->weight;
                }

                $packages[$package->package_type_id] = $new_package;
            }
        }

        $data['packages'] = $packages;

        $agent = $posts->first()->agent;

        $data['agent'] = $agent;

        return view('cargo::warehouse-assign-pickup', $data);

    }



}
