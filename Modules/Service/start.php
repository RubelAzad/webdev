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


if ( ! function_exists('get_service_price')){
    function get_service_price($amount, $commission, $agent = ''){

        if($agent){
            $commission_amount = ($amount * $commission) / 100;
            return number_format($amount + $commission_amount  , 2) + get_agent_increment($amount, $commission, $agent);
        }else{
            return number_format($amount + (($amount * $commission) / 100) , 2);
        }

    }
}

if( ! function_exists('get_agent_increment') ){
    function get_agent_increment($original_amount, $original_commission, $agent = ''){
        $original_commission_amount = ($original_amount * $original_commission) / 100;
        $agent_commission = (($original_commission_amount * $agent->commission) / 100);
        $increment_amount = ($agent_commission * $agent->increment) / 100;

        return number_format($increment_amount , 2);
    }
}


if( ! function_exists('get_agent_commission_on_weight') ){
    function get_agent_commission_on_weight($amount, $commission, $agent = ''){
        $commission_amount = ($amount * $commission) / 100;

        if($agent){
            $commission_agent = (($commission_amount * $agent->commission) / 100);
            return number_format($commission_agent , 2) + get_agent_increment($amount, $commission, $agent);
        }

        return number_format($commission_amount , 2);
    }
}

if ( ! function_exists('get_service_price_total')){
    function get_service_price_total($base_price, $price, $commission, $quantity, $agent = ''){

        $base_price = get_service_price($base_price,$commission, $agent);


        $total = $price * $quantity;

        if($total >= $base_price){
            return number_format($total, 2);
        }else{
            return number_format($base_price,2);
        }
    }
}

if( ! function_exists('get_valuable_items') ){
    function get_valuable_items(){
        $items = \Modules\Service\Entities\ServiceValuable::active()->get();

        if($items->count()){
            return $items;
        }

        return collect();
    }
}

if( ! function_exists('get_valuable_items_by_source_destination') ){
    function get_valuable_items_by_source_destination($src, $dst){
        $items = \Modules\Service\Entities\ServiceValuable::active()
            ->where('src_country', $src)
            ->where('dst_country',  $dst)
            ->orderByRaw('name')
            ->get();

        if($items->count()){
            return $items;
        }

        return collect();
    }
}

if ( ! function_exists('get_countries_by_src_for_select')){
    function get_countries_by_src_for_select($src){

        $services = \Modules\Service\Entities\Service::select('dst_country')->where('src_country', '=', $src)->distinct()->get();

        $countries =  \Modules\Location\Entities\Country::select('name', 'iso_3166_3')->whereIn('iso_3166_3', $services->pluck('dst_country'))->get()->pluck('name','iso_3166_3');


        return $countries;
    }
}

if( ! function_exists('get_agent_valuable_price')){
    function get_agent_valuable_price($id, $cost, $agent){
        $item = \Modules\Service\Entities\ServiceValuable::find($id);

        $item_commission = $item->price * $item->commission / 100;

        $agent_commission = $item_commission * $agent->commission_valuable / 100;

        // if max price was applied
        if($cost > $item->price){
            $agent_commission = $agent_commission + ($cost - $item->price);
        }

        return $agent_commission;
    }
}
