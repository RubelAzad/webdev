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

if( ! function_exists('get_total_weight_in_hawb')){
    function get_total_weight_in_hawb($id){
        $hawb = \Modules\Shipment\Entities\HouseAirWayBill::find($id);
        $total = 0;

        foreach ($hawb->posts as $post){
            $total = $total + get_total_weight($post->actual_post->packages);
        }

        return $total;
    }
}

if( ! function_exists('get_number_of_packages_in_hawb')){
    function get_number_of_packages_in_hawb($id){
        $hawb = \Modules\Shipment\Entities\HouseAirWayBill::find($id);

        $total = 0;

        foreach ($hawb->posts as $post){
            $total = $total + $post->actual_post->packages->count();
        }

        return $total;
    }
}
