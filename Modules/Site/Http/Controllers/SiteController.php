<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\Site;
use App\Setting;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('site::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('site::create');
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
        return view('site::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('site::edit');
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

    public function settings(){
        if (Gate::denies('manage_website', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        return view('site::settings.index', $data);
    }

    public function settings_update(Request $request){

        $this->update_settings('customer_care_number', $request->customer_care_number);
        $this->update_settings('customer_care_email', $request->customer_care_email);
        $this->update_settings('contact_page_message', $request->contact_page_message);

        if($request->has('file')){
            if(get_settings('main_logo')){
                //delete th previous file
                delete_file_by_hash_final(get_settings('main_logo'));
            }

            // add the new file
            $path = 'site/';
            $this->update_settings('main_logo', save_file_to_db($request, $path));
        }

        $this->update_settings('facebook', $request->facebook);
        $this->update_settings('twitter', $request->twitter);
        $this->update_settings('linkedin', $request->linkedin);
        $this->update_settings('youtube', $request->youtube);

        flash()->success('Settings Updated!')->important();

        return redirect()->back();
    }

    public function update_settings($key, $value){
        $settings = Setting::where('key', $key)->get()->first();
        if( ! $settings){
            $settings = new Setting;
            $settings->key = $key;
        }
        if($value){
            $settings->value = $value;
        }else{
            $settings->value = null;
        }


        if($settings->save()){
            session(['config' => Setting::all()->pluck('value', 'key')]); // re-initiate the config value
            return true;
        }

    }
}
