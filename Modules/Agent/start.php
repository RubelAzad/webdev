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

if( ! function_exists('discount_allowed')){
    function discount_allowed($agent_id){
        $agent = \Modules\Agent\Entities\Agent::find($agent_id);

        return $agent->allow_discount;
    }
}

if( ! function_exists('get_agents') ){
    function get_agents(){
        $agents = \Modules\Agent\Entities\Agent::active()->get();

        return $agents;
    }
}
