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

if ( ! function_exists('get_officer_type_id')){
    function get_officer_type_id($name){
        return '';
    }
}


if( ! function_exists('calculate_draft_amount_total') ){
    function calculate_draft_amount_total($draft_id){
        $draft = \Modules\Cargo\Entities\CargoDraft::find($draft_id);

        $service = $draft->service;

        $delivery = collect(json_decode($draft->delivery));

        $delivery_cost = 0;
        if($delivery->has('delivery') && $delivery->get('delivery')){
            $delivery_cost = $delivery_cost + $delivery->get('price');
        }else{
            $delivery_cost = $delivery_cost + $delivery->get('collection_price');
        }

        $total = 0;

        // find actual shipment cost
        $package_total = number_format(get_total_weight(json_decode($draft->packages)) * get_service_price($service->price, $service->commission, $draft->agent), 2);
        $total = $total + parseFloat($package_total);

        // get additional cost information
        if($draft->items){
            $items = json_decode($draft->items, true);
            $tax_total = number_format(array_sum(array_pluck($items, 'cost')), 2);
            $total = $total + $tax_total;
        }



        // get insurance cost
        $insurance_price = 0;
        if($draft->insurance){
            $insurance = json_decode($draft->insurance);
            foreach ($insurance as $item){
                if( $item->keep){
                    $insurance_price = $insurance_price + $item->cost;
                }
            }
            $insurance_price = number_format($insurance_price, 2);
        }
        $total = $total + $insurance_price;


        // additional cost
        if($draft->optionals){
            $packaging = json_decode($draft->optionals);
            if(isset($packaging->pickup_cost) && $packaging->pickup_cost){
                $total = $total + $packaging->pickup_cost;
            }

            if(isset($packaging->packaging_price)){
                $total = $total + $packaging->packaging_price;
            }

            $total = $total + $delivery_cost;

            if($packaging && isset($packaging->discount)){
                $discount = $packaging->discount;
            }else{
                $discount = 0;
            }

            $total = $total - $discount;
        }

        if(get_settings('vat', 0)){
            $vat = number_format($total * get_settings('vat', 0) / 100, 2);
            $total = $total + $vat;
        }


        return $total;
    }
}

if( ! function_exists('get_maximum_discount_allowed') ){
    function get_maximum_discount_allowed(\Modules\Cargo\Entities\CargoDraft $draft){

        $total_weight = get_total_weight(json_decode($draft->packages));

        $service = $draft->service;
        $agent = $draft->agent;

        $base_price = get_agent_commission_on_weight($service->base_price, $service->commission, $agent); // commission on base price
        $unit_price = get_agent_commission_on_weight($service->price, $service->commission, $agent) * $total_weight; // commission on unit price

        $base_price = parseFloat($base_price);
        $unit_price = parseFloat($unit_price);

        $total = $base_price >= $unit_price ? $base_price : $unit_price; // discount allowed


        //check additional cost packaging and delivery and add to the total

        if($draft->optionals){
            $packaging = json_decode($draft->optionals);

            if(property_exists($packaging, 'packaging') && $packaging->packaging){
                if(isset($packaging->packaging_price)){
                    $total = $total + $packaging->packaging_price;
                }
            }
        }

        // add agent commission for valuable items
        if($items = json_decode($draft->items, true)){
            foreach($items as $item){
                $agent_commission_valuable = get_agent_valuable_price($item['id'], $item['cost'], $agent);
                $total = $total + $agent_commission_valuable;
            }
        }

        // add commission from insurance
        $insurance_price = 0;
        if($draft->insurance){
            $insurance = json_decode($draft->insurance);

            foreach($insurance as $item){
                if($item->keep){
                    $insurance_price = $insurance_price + $item->cost;
                }
            }

            $insurance_agent_commission = 0;

            if($insurance_price){
                $insurance_commission = $insurance_price * get_settings('insurance_commission') / 100;

                $insurance_agent_commission = $insurance_commission * get_settings('insurance_commission_agent') / 100;
            }

            $total = $total + $insurance_agent_commission;
        }


        return number_format($total,2);
    }
}


if( ! function_exists('get_packages_to_get_quote')){
    function get_packages_to_get_quote($request){
        $packages = collect();
        $inputs = $request->input();
        foreach ($inputs as $input => $value){
            if(starts_with($input, 'row')){
                $packages->put($input, $value);
            }
        }

        $packages =  $packages->chunk(5);

        $data = collect();

        // add packages to search quote
        $i = 1;
        foreach ($packages as $package){
            $type = 'row-'.$i.'-package_type';
            $weight = 'row-'.$i.'-weight';
            $height = 'row-'.$i.'-height';
            $length = 'row-'.$i.'-length';
            $width = 'row-'.$i.'-width';

            //dd($package[$type]);

            $piece = new stdClass();
            $piece->PieceID = $i;
            $piece->type = $package[$type];
            $piece->Height = $package[$height];
            $piece->Depth = $package[$length];
            $piece->Width = $package[$width];
            $piece->Weight = $package[$weight];

            $data->push($piece);

            $i = $i+1;
        }

        return $data;
    }
}

