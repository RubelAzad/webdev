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

if( ! function_exists('calculate_post_amount_total') ){
    function calculate_post_amount_total(\Modules\Cargo\Entities\CargoPost $post){


        $total = 0;

        $total_weight = get_total_weight($post->packages);

        // find actual price on weight
        $package_total = number_format( $total_weight * $post->unit_price, 2);
        $package_total = parseFloat($package_total >= $post->base_price ? $package_total : $post->base_price);
        $total = $total + $package_total;
        //$loca_charge =$post->billing->location_charge;

        if($post->billing->location_charge){
            $total = $total + ($total_weight * $post->billing->location_charge);
        }
        //if( $loca_charge > 0) {
            //$total = $total + ($total_weight * $loca_charge);
        //}elseif($loca_charge <= 0){
           // $total = $total + $total_weight;
        //}

        if($post->transport_cost){
            $total = $total + $post->transport_cost;
        }


        // additional cost for valuable items
        if($items = $post->items){
            $tax_total = number_format($items->sum('tax'), 2);
            $total = $total + $tax_total;
        }

        // cost for insurance
        if($post->insurances->count()){
            $total = $total + $post->insurances->sum('cost');
        }

        // additional cost for packaging
        if($post->packaging){
            $total = $total + $post->packaging_price;
        }

        // additional cost for pickup
        if($post->pickup_cost){
            $total = $total + $post->pickup_cost;
        }

        // additional cost for delivery
        if($post->delivery && $post->delivery->price){
            $total = $total + $post->delivery->price;
        }

        // if there was discount
        if($post->discount){
            $total = $total - $post->discount;
        }

        if($post->vat){
            $vat = $total * $post->vat / 100;
            $total = $total + $vat;
        }



        return $total;
    }
}

if( ! function_exists('get_post_total_for_agent_billing') ){
    function get_post_total_for_agent_billing(\Modules\Cargo\Entities\CargoPost $post){

        $total = 0;

        $total_weight = get_total_weight($post->packages);
        $loca_charge =$post->billing->location_charge;

        if( $loca_charge > 0) {
            $total = $total + ($total_weight * $loca_charge);
        }elseif($loca_charge <= 0){
            $total = $total + $total_weight;
        }

        // Head Office price for packages
        $billing = $post->billing;

        $base_price = $billing->base_price;
        //$base_price_agent = $billing->base_price + ($billing->base_price * $billing->weight_commission_franchise) / 100;

        $unit_price = $billing->unit_price;
        //$unit_price_agent = $billing->unit_price + ($billing->unit_price * $billing->weight_commission_franchise) / 100;


        //$total_agent_price_unit = number_format($unit_price_agent, 2) * $total_weight;
        $total_ho_price_unit = number_format($unit_price, 2) * $total_weight;

        $final_ho_selling_price = $total_ho_price_unit >= $base_price ? $total_ho_price_unit : $base_price;
        //$final_agent_selling_price = $total_agent_price_unit >= $base_price_agent ? $total_agent_price_unit : $base_price_agent;

        // Head Office price for packages

        //How much franchise would get from here;
        $distribute_commission = $final_ho_selling_price * $billing->weight_commission_franchise / 100;
        $agent_com = $distribute_commission * $billing->weight_commission_agent / 100;
        $franchise_com = $distribute_commission - $agent_com;

        $selling_price_with_franchise = parseFloat($final_ho_selling_price) + parseFloat($franchise_com);

        //return $selling_price_with_franchise;

        $total = $total + $selling_price_with_franchise;

        //return $total;

        // add transport cost
        if($post->transport_cost){
            $total = $total + $post->transport_cost;
        }


        // additional cost for valuable items
        $items = $post->items;
        if($items->count()){

            $valuable_item_total = number_format($items->sum('original_tax'), 2);

            // now need to deduct the agent commission
            foreach ($items as $item){
                $valuable_item_total = $valuable_item_total - $item->commission_agent;
            }

            $total = $total + $valuable_item_total;

        }


        // cost for insurance
        if($post->insurances->count()){
            $total = $total + $post->insurances->sum('cost') - $post->insurances->sum('com_agent');
        }

        // additional cost for packaging
        // we won't take any money from agent for additional packaging

        // additional cost for pickup
//        if($post->pickup_cost){
//            $total = $total + $post->pickup_cost;
//        }

        // additional cost for delivery
        if($post->delivery && $post->delivery->price){
            $total = $total + $post->delivery->price;
        }

        // if there was discount ?
        // we didn't add any commission for agent, so discount will not be counted

        if($post->vat){
            $vat = $total * $post->vat / 100;
            $total = $total + $vat;
        }



        return $total;
    }

    if( ! function_exists('total_unpicked_post_booking_from_agent') ){
        function total_unpicked_post_booking_from_agent(){
            $pickups = \Modules\Cargo\Entities\CargoPickup::not_picked()->get();

            return $pickups->count();
        }
    }
}

if( ! function_exists('get_agent_commission_on_weight_post')){
    function get_agent_commission_on_weight_post(\Modules\Cargo\Entities\CargoPost $post){

        $billing = $post->billing;

        $total_weight = get_total_weight($post->packages);

        //base price or unit price ?
        $base_price_ho = $billing->base_price;
        $base_price_agent = $post->base_price;

        $unit_price_ho = $billing->unit_price;
        $unit_price_agent = $post->unit_price;

        $total_unit_price_ho = $unit_price_ho * $total_weight;
        $total_unit_price_agent = $unit_price_agent * $total_weight;

        $selling_price_ho = $base_price_ho >= $total_unit_price_ho ? $base_price_ho : $total_unit_price_ho;
        $selling_price_agent = $base_price_agent >= $total_unit_price_agent ? $base_price_agent : $total_unit_price_agent;

        //How much franchise would get from here;
        $distribute_commission = $selling_price_ho * $billing->weight_commission_franchise / 100;
        $agent_com = $distribute_commission * $billing->weight_commission_agent / 100;
        $franchise_com = $distribute_commission - $agent_com;

        $selling_price_with_franchise = parseFloat($selling_price_ho) + parseFloat($franchise_com);

        $final = $selling_price_agent - $selling_price_with_franchise;


        return $final;
    }
}

if( ! function_exists('get_franchise_commission_on_weight_post')){
    function get_franchise_commission_on_weight_post(\Modules\Cargo\Entities\CargoPost $post){

        $total_weight = get_total_weight($post->packages);

        // Head Office price for packages
        $billing = $post->billing;
        $unit_price_ho = parseFloat($total_weight * $billing->unit_price);
        $base_price_ho = $billing->base_price;
        $package_total_ho = parseFloat($unit_price_ho >= $base_price_ho ? $unit_price_ho : $base_price_ho);

        //How much franchise would get from here;
        $distribute_commission = $package_total_ho * $billing->weight_commission_franchise / 100;
        $agent_com = $distribute_commission * $billing->weight_commission_agent / 100;
        $franchise_com = $distribute_commission - $agent_com;


        return $franchise_com;
    }
}

if( ! function_exists('get_agent_com_on_items_post')){
    function get_agent_com_on_items_post(\Modules\Cargo\Entities\CargoPost $post){
        $total = 0;

        if($post->items->count()){
            $item_original_total = number_format($post->items->sum('original_tax'), 2);
            $item_sell_total = number_format($post->items->sum('tax'), 2);

            $total = $total + ($item_sell_total - $item_original_total);

            $total = $total + $post->items->sum('commission_agent');
        }


        return $total;
    }
}


