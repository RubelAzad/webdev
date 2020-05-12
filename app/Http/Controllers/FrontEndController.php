<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DHL\Client\Web;
use DHL\Datatype\AM\PieceType;
use DHL\Entity\AM\GetQuote;
use Illuminate\Http\Request;
use Modules\Cargo\Entities\CargoPost;
use Modules\Enquiry\Emails\EnquiryToOfficeMail;
use Modules\Enquiry\Entities\Enquiry;
use Modules\Enquiry\Notifications\EnquiryCreated;
use Modules\Enquiry\Notifications\EnquiryToOffice;
use Modules\Location\Entities\Country;
use Modules\Pickup\Entities\Pickup;
use Modules\Pickup\Notifications\NewPickupRequestCreated;
use Modules\Site\Entities\SiteNews;
use Modules\Site\Entities\SitePage;
use Modules\Site\Entities\SiteService;
use Mail;
class FrontEndController extends Controller
{
    public function index(){
        $data = array();
        $data['f_page'] = SitePage::where('featured', 1)->get()->first();
        $pages = SitePage::where('featured', 0)
            ->where('front_page', 1)
            ->where('active', 1)
            ->limit(3)
            ->orderBy('position')
            ->get();
        $data['pages'] = $pages;


        $data['services'] = SiteService::where('front_page', 1)
            ->where('active', 1)
            ->limit(6)
            ->get();

        return view('nec.index', $data);
    }

    public function about(){
        return redirect('page/about-us');
    }

    public function get_quote(){
        $data = array();
        return view('front-end.get_quote', $data);
    }

    public function get_quote_now(Request $request){
        $quote = new GetQuote();
        $quote->SiteID = config('dhl.id');
        $quote->Password = config('dhl.pass');

        // Set values of the request
        $quote->MessageTime = Carbon::now()->format('Y-m-d') .'T'. Carbon::now()->format('H:i:s');//'2018-12-01T09:30:47-05:00';//;
        $quote->MessageReference = 'NEC-Cargo-123456789-123456789';
        $quote->BkgDetails->Date = Carbon::now()->format('Y-m-d');

        $piece = new PieceType();
        $piece->PieceID = 1;
        $piece->Height = 10;
        $piece->Depth = 5;
        $piece->Width = 10;
        $piece->Weight = 10;

        $quote->BkgDetails->addPiece($piece);
        $quote->BkgDetails->IsDutiable = 'Y';
        $quote->BkgDetails->ReadyTime = 'PT10H21M';
        $quote->BkgDetails->ReadyTimeGMTOffset = '+01:00';
        $quote->BkgDetails->DimensionUnit = 'CM';
        $quote->BkgDetails->WeightUnit = 'KG';
        $quote->BkgDetails->PaymentCountryCode = 'GB';
        $quote->BkgDetails->IsDutiable = 'Y';

        // Request Paperless trade
        $quote->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';

        $quote->From->CountryCode = 'GB';
        $quote->From->Postalcode = 'E78AW';
        $quote->From->City = 'London';

        $quote->To->CountryCode = 'CH';
        $quote->To->Postalcode = '1226';
        $quote->To->City = 'Thonex';
        $quote->Dutiable->DeclaredValue = '100.00';
        $quote->Dutiable->DeclaredCurrency = 'CHF';

        // Call DHL XML API
        $start = microtime(true);
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

        $prices = $result->GetQuoteResponse->BkgDetails->QtdShp;
        dump($piece);
        foreach ($prices as $price){
            dump($price);
        }
        //dd($array['GetQuoteResponse']);

        //return redirect()->back();
    }

    public function track(){
        $data = array();
        $data['searched'] = false;
        $data['found'] = false;
        $data['post'] = false;
    }

    public function track_result(Request $request){
        $post = CargoPost::where('tracking_no', '=', $request->tracking_number)->get()->first();

        $data = array();
        $data['searched'] = true;
        $data['found'] = false;
        $data['post'] = $post;
        if( $post ){
            $data['found'] = true;
        }

        return view('nec.track', $data);
    }

    public function show_page($slug = ''){
        if (! $slug){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        $page = SitePage::where('slug', '=', $slug)->get()->first();

        $data = array();
        $data['page'] = $page;

        return view('nec.page', $data);
    }

    public function show_news($slug = ''){

        $data = array();
        $data['slug'] = $slug;
        if($slug){
            $page = SiteNews::where('slug', '=', $slug)->get()->first();
            $data['page'] = $page;
            return view('nec.article', $data);
        }

        $pages = SiteNews::active()->orderBy('id', 'desc')->paginate(5);
        $data['pages'] = $pages;

        return view('nec.news', $data);
    }

    public function show_service($slug = ''){
        if (! $slug){
            return view('nec.all-service', ['slug' => '']);
        }

        $page = SiteService::where('slug', '=', $slug)->get()->first();

        $data = array();
        $data['page'] = $page;
        $data['area'] = 'Services';
        $data['slug'] = $slug;

        return view('nec.service', $data);
    }

    public function contact_us(){

        $data = array();
        $countries = Country::all();
        $data['countries'] = $countries;

        return view('nec.contact-us', $data);
    }

    public function faq(){
        return view('front-end.faq');
    }

    public function send_contact_us(Request $request){

        $this->validate($request,
            [
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'g-recaptcha-response.required' => 'Please prove you are a human!'
            ]
        );

        $enquiry = new Enquiry;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone_number = $request->phone_number;
        $enquiry->subject = $request->subject;
        $enquiry->message = $request->message;
        $enquiry->send_copy = $request->has('send_copy') ? 1 : 0 ;

        if($enquiry->save()){
            // send notification to office
            $enquiry->notify(new EnquiryToOffice($enquiry));

            // send email to customer care
            if(get_settings('customer_care_email')){
                Mail::to(get_settings('customer_care_email'))->send(new EnquiryToOfficeMail($enquiry));
            }
            
            // send notification to sender if requested
            if($enquiry->send_copy){
                $enquiry->notify(new EnquiryCreated($enquiry));
            }

            alert()->success('Your message has been sent!')->persistent('Close');
        }
        return redirect()->back();
    }

    public function request_pickup(){
        return view('nec.request-pickup');
    }

    public function update_request_pickup(Request $request){

        $this->validate($request,
            [
                'g-recaptcha-response' => 'required|captcha',
                'preferred_time' => 'required'
            ],
            [
                'g-recaptcha-response.required' => 'Please prove you are a human!'
            ]
        );

        $pickup = new Pickup;
        $pickup->name = $request->name;
        $pickup->address_line_1 = $request->address_line_1;
        $pickup->address_line_2 = $request->address_line_2;
        $pickup->address_line_3 = $request->address_line_3;
        $pickup->city = $request->city;
        $pickup->county = $request->county;
        $pickup->postcode = $request->postcode;
        $pickup->country_code = 'GBR';
        $pickup->phone_number = $request->phone_number;
        $pickup->email = $request->email;
        $pickup->note = $request->note;
        $pickup->quantity = $request->quantity;
        $pickup->weight = $request->weight;
        $pickup->description = $request->description;
        $pickup->preferred_date = Carbon::createFromFormat('d/m/Y', $request->preferred_date);
        $pickup->preferred_time = $request->preferred_time;

        if($pickup->save()){
            // send email notification
            if($pickup->email){
                $pickup->notify(new NewPickupRequestCreated($pickup));
            }
            alert()->success('We have received your request. We will contact you soon!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function support(){
        $data = array();
        $data['categories'] = get_faq_categories();
        return view('nec.faq', $data);
    }

    public function network(){
        return view('nec.network');
    }

    public function career(){
        return view('nec.career');
    }

    public function post_career(Request $request){
        alert()->success('We have received your information!')->persistent('Close');
        return redirect()->back();
    }
    public function find_location(){
        return view('nec.find-location');
    }
    public function find_track(){
        $data = array();
        $data['searched'] = false;
        $data['found'] = false;
        $data['post'] = false;
    }

    public function find_track_result(Request $request){
        //$post = CargoPost::where('receiver->postcode', '=', $request->postcode)->get()->first();
        $post = CargoPost::where('tracking_no', '=', $request->tracking_number)->get()->first();
        $data = array();
        $data['searched'] = true;
        $data['found'] = false;
        $data['post'] = $post;
        if( $post ){
            $data['found'] = true;
        }

        return view('nec.find-locaiton', $data);
    }
}
