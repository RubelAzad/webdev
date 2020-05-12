<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Status;
use Illuminate\Http\Request;
use Gate;
use Modules\Cargo\Entities\CargoPackageType;

class SettingsController extends Controller
{
    public function index(){
        return view('back-end.settings.index');
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

    public function update_package(Request $request){
        //return $request->input();

        if($request->powered_by){
            $this->update_settings('powered_by', $request->powered_by);
        }else{
            $this->update_settings('powered_by', null);
        }


        if($request->mass_divider){
            $this->update_settings('mass_divider', $request->mass_divider);
        }else{
            $this->update_settings('mass_divider', null);
        }

        if($request->tandc4parcel){
            $this->update_settings('tandc4parcel', $request->tandc4parcel);
        }else{
            $this->update_settings('tandc4parcel', null);
        }

        if($request->insurance_notice){
            $this->update_settings('insurance_notice', $request->insurance_notice);
        }else{
            $this->update_settings('insurance_notice', null);
        }

        flash('General settings update!')->success()->important();


        return redirect('settings#tab-package');
    }

    public function update_billing(Request $request){
        //return $request->input();


        if($request->commission_increment){
            $this->update_settings('commission_increment', $request->commission_increment);
        }else{
            $this->update_settings('commission_increment', null);
        }

        if($request->insurance){
            $this->update_settings('insurance', $request->insurance);
        }else{
            $this->update_settings('insurance', null);
        }

        if($request->max_insurance){
            $this->update_settings('max_insurance', $request->max_insurance);
        }else{
            $this->update_settings('max_insurance', null);
        }

        if($request->insurance_commission){
            $this->update_settings('insurance_commission', $request->insurance_commission);
        }else{
            $this->update_settings('insurance_commission', null);
        }

        if($request->insurance_commission_franchise){
            $this->update_settings('insurance_commission_franchise', $request->insurance_commission_franchise);
        }else{
            $this->update_settings('insurance_commission_franchise', null);
        }

        if($request->insurance_commission_agent){
            $this->update_settings('insurance_commission_agent', $request->insurance_commission_agent);
        }else{
            $this->update_settings('insurance_commission_agent', null);
        }


        if($request->valuable_commission_franchise){
            $this->update_settings('valuable_commission_franchise', $request->valuable_commission_franchise);
        }else{
            $this->update_settings('valuable_commission_franchise', null);
        }

        if($request->valuable_commission_agent){
            $this->update_settings('valuable_commission_agent', $request->valuable_commission_agent);
        }else{
            $this->update_settings('valuable_commission_agent', null);
        }

        flash('Billing settings update!')->success()->important();


        return redirect('settings#tab-package');
    }


    public function show_status(){
        $data = array();
        $data['statuses'] = Status::all();
        return view('back-end.settings.status', $data);
    }

    public function show_package_type(){
        if (Gate::denies('manage_package_type', CargoPackageType::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $types = CargoPackageType::active()->get();

        $data = array();
        $data['types'] =  $types;

        return view('back-end.settings.package-type.index', $data);
    }

    public function package_type_get($id){
        $type = CargoPackageType::find($id);

        return $type;
    }


    public function update_package_type(Request $request){
        if($request->type_id){
            $type = CargoPackageType::find($request->type_id);
        }else{
            $type = new CargoPackageType;

            $code = str_slug($request->name,'_');

            $ex_type = CargoPackageType::where('code', '=', $code)->get()->first();

            if($ex_type){
                $type->code = $code . '1';
            }else{
                $type->code = $code;
            }

        }

        $type->name = $request->name;

        if($type->save()){
            return ['success' => true];
        }else{
            return ['success' => false];
        }
    }

    public function package_type_delete($id){
        $type = CargoPackageType::find($id);

        if(strtoupper($type->code) != strtoupper('doc')){
            $type->active = false;

            if($type && $type->save()){
                alert()->success('Package type has been deleted!')->persistent('Close');
            }else{
                alert()->error('Something went wrong, please try again later!')->persistent('Close');
            }
        }else{
            alert()->error('You are not allowed to delete document!')->persistent('Close');
        }

        return redirect()->back();
    }

}
