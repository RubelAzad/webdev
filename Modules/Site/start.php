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

if( ! function_exists('get_main_logo_url')){
    function get_main_logo_url(){
        $logo = get_settings('main_logo', '');

        if($logo){
            return url('file/serve/' . $logo);
        }

        return url('img/logo.png');
    }
}

if( ! function_exists('get_site_services') ){
    function get_site_services(){
        $services = \Modules\Site\Entities\SiteService::active()->orderBy('position')->get();

        return $services;
    }
}

if( ! function_exists('get_site_feeds') ){
    function get_site_feeds(){
        $feeds = \Modules\Site\Entities\SiteFeed::active()->get();

        return $feeds;
    }
}

if( ! function_exists('get_slide_shows') ){
    function get_slide_shows(){
        $slide_shows = \Modules\Site\Entities\SiteSlideShow::active()->get();

        return $slide_shows;
    }
}

if( ! function_exists('get_site_news') ){
    function get_site_news($limit = ''){
        $news = \Modules\Site\Entities\SiteNews::active()->orderBy('id', 'desc')->limit($limit)->get();

        return $news;
    }
}

if( ! function_exists('get_partners') ){
    function get_partners(){
        $partners = \Modules\Site\Entities\SitePartner::active()->get();

        return $partners;
    }
}

if( ! function_exists('get_testimonials') ){
    function get_testimonials(){
        $partners = \Modules\Site\Entities\SiteTestimonial::active()->get();

        return $partners;
    }
}

if( ! function_exists('get_faq_categories')){
    function get_faq_categories(){
        $categories = \Modules\Site\Entities\SiteFaqCategory::active()->get();
        return $categories;
    }
}
