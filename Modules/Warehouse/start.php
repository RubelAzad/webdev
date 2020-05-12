<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

if( ! function_exists('get_warehouse_name_by_id') ){
    function get_warehouse_name_by_id($id){
        $house = \Modules\Warehouse\Entities\Warehouse::find($id);

        return $house->name;
    }
}