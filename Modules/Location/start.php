<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces And Routes
|--------------------------------------------------------------------------
|
| When a module starting, this file will executed automatically. This helps
| to register some namespaces like translator or view. Also this file
| will load the routes file for each module. You may also modify
| this file as you want.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

if ( ! function_exists('get_countries_for_select')){
    function get_countries_for_select($area = ''){
        if($area){
            $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_3')->whereIn('iso_3166_3', explode(',', str_replace(' ','',$area)))->get()->pluck('name','iso_3166_3');
        }else{
            $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_3')->get()->pluck('name','iso_3166_3');
        }


        return $countries;
    }
}

if ( ! function_exists('get_countries_for_select_2')){
    function get_countries_for_select_2($area = ''){
        if($area){
            $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_2')->whereIn('iso_3166_2', explode(',', str_replace(' ','',$area)))->get()->pluck('name','iso_3166_2');
        }else{
            $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_2')->get()->pluck('name','iso_3166_2');
        }


        return $countries;
    }
}

if ( ! function_exists('get_sending_countries')){
    function get_sending_countries(){

        $destinations = Modules\Service\Entities\Service::select('src_country')->distinct()->get();

        $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_3')->whereIn('iso_3166_3', $destinations->pluck('src_country'))->get()->pluck('name','iso_3166_3');


        return $countries;
    }
}

if ( ! function_exists('get_country_by_iso_3166_2')){
    function get_country_by_iso_3166_2($code = ''){

        $country =  \Modules\Location\Entities\Country::where('iso_3166_2', '=', $code)->get()->first();

        return $country;

    }
}

if ( ! function_exists('get_country_by_iso_3166_3')){
    function get_country_by_iso_3166_3($code = ''){

        $country =  \Modules\Location\Entities\Country::where('iso_3166_3', '=', $code)->get()->first();

        return $country;

    }
}

if ( ! function_exists('get_country_name')){
    function get_country_name($code){
        $countries =  \Modules\Location\Entities\Country::select('name')->where('iso_3166_3', $code)->get()->first();

        return $countries->name;
    }
}

if ( ! function_exists('get_country_name_iso_3166_2')){
    function get_country_name_iso_3166_2($code){
        $countries =  \Modules\Location\Entities\Country::select('name')->where('iso_3166_2', $code)->get()->first();

        return $countries->name;
    }
}

if ( ! function_exists('get_number_of_zones')){
    function get_number_of_zones($code){
        $zones = \Modules\Location\Entities\Zone::select('id')->where('country_code', '=', $code)->get()->count();

        if($zones){
            return $zones;
        }

        return 0;
    }
}

if ( ! function_exists('get_number_of_franchises')){
    function get_number_of_franchises($code){
        $franchise = \Modules\Franchise\Entities\Franchise::select('id')->where('country', '=', $code)->get()->count();

        if($franchise){
            return $franchise;
        }

        return 0;
    }
}

if ( ! function_exists('get_franchises_by_country')){
    function get_franchises_by_country($code){
        $franchise = \Modules\Franchise\Entities\Franchise::where('country', '=', $code)
            ->get();

        if($franchise->count()){
            return $franchise;
        }

        return collect();
    }
}

if ( ! function_exists('get_number_of_agents')){
    function get_number_of_agents($code){
        $agents = get_agents_by_country($code);

        if($agents){
            return $agents->count();
        }

        return 0;
    }
}

if ( ! function_exists('get_agents_by_country')){
    function get_agents_by_country($code){
        $agents = \Modules\Agent\Entities\Agent::where('country', '=', $code)
            ->where('active', 1)
            ->where('approved', 1)
            ->get();

        if($agents){
            return $agents;
        }

        return collect();
    }
}

if ( ! function_exists('get_agent_by_id') ){
    function get_agent_by_id($agent_id){
        $agent = \Modules\Agent\Entities\Agent::find($agent_id);

        if ($agent){
            return $agent;
        }
        return false;
    }
}

if ( ! function_exists('get_currency_symbol') ){
    function get_currency_symbol($country_code){
        $country = \Modules\Location\Entities\Country::where('iso_3166_3', '=', $country_code)->get()->first();

        return $country->currency_symbol;
    }
}

if ( ! function_exists('get_vat_by_country_3166_3') ){
    function get_vat_by_country_3166_3($sender_country_code, $receiver_country_code){
        $src_country = \Modules\Location\Entities\Country::where('iso_3166_3', $sender_country_code)->get()->first();
        $dst_country = \Modules\Location\Entities\Country::where('iso_3166_3', $receiver_country_code)->get()->first();

        $vat = \Modules\Location\Entities\CountryVat::where('country_id', $src_country->id)->where('dst_country_id', $dst_country->id)->get()->first();

        if($vat){
            return number_format($vat->vat, 2);
        }

        return number_format(0, 2);
    }
}
