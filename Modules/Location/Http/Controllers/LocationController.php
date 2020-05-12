<?php

namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Location\Entities\Country;
use GoogleMaps;
use Modules\Location\Entities\CountryVat;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('location::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('location::create');
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
        return view('location::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('location::edit');
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

    public function countries(){
        $data = array();
        $countries = Country::all();
        $data['countries'] = $countries;

        return view('location::country.index', $data);
    }

    public function country($code = ''){
        $data = array();
        $country = Country::where('iso_3166_3', $code)->get()->first();
        $data['country'] = $country;

        return view('location::country.view', $data);
    }

    public function country_vat($id){
        $data = array();
        $country = Country::find($id);
        $data['country'] = $country;

        $data['countries'] = Country::all();

        return view('location::country.vat', $data);
    }

    public function find_us(){
        return view('location::front-end.find-us');
    }

    public function get_location_hint(Request $request){

        $response = GoogleMaps::load('placeautocomplete')
            ->setParam([
                'input' => 'e7',//$request->query,
                'components' => [
                    'country' => $request->country_code
                ]
            ])
            ->get();

        $response = json_decode($response, true); // convert to array

        return $response;

        $rows = collect();

        if(count($response['predictions'])){

            $address_components = $response['predictions'];

            foreach ($rows as $row){
                $type = $component['types'];
                if($type[0] == 'postal_town'){
                    $rows->push($component['long_name']);
                }
            }
        }

        return $rows;
    }

    public function update_vat(Request $request){

        $inputs = $request->input();

        $country = Country::find($request->country_id);

        foreach ($inputs as $input => $value){

            if(starts_with($input, 'id')){

                $key_part = explode('-', $input);
                $dst_country_id = $key_part[1];

                $vat = CountryVat::where('country_id', $country->id)->where('dst_country_id', $dst_country_id)->get()->first();

                if( ! $vat){
                    $vat = new CountryVat;
                    $vat->country_id = $country->id;
                    $vat->dst_country_id = $dst_country_id;
                }

                $vat->vat = $value;

                $country->vats()->save($vat);
            }

        }

        alert()->success('Updated!')->persistent('Close');

        return redirect()->back();
    }


}
