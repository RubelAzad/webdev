<?php

namespace Modules\Warehouse\Http\Controllers;

use App\Role;
use App\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\CargoPickup;
use Modules\Cargo\Entities\CargoPost;
use Modules\Cargo\Entities\CargoPostHistory;
use Modules\Cargo\Entities\CargoPostStatus;
use Modules\Warehouse\Entities\Warehouse;
use Gate;
use Modules\Warehouse\Entities\WarehouseEmployee;
use Modules\Warehouse\Entities\WarehouseExternalDriver;
use Modules\Warehouse\Entities\WarehousePickup;
use Modules\Warehouse\Entities\WarehousePickupPost;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        $data = array();

        $houses = Warehouse::all();

        $data['houses'] = $houses;

        return view('warehouse::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('create_warehouse', Warehouse::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        return view('warehouse::create');
    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id = ''){

        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('view_warehouse', Warehouse::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $house = Warehouse::find($id);

        $data['house'] = $house;
        $data['drivers'] = $house->external_drivers;

        return view('warehouse::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id = ''){

        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('edit_warehouse', Warehouse::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $house = Warehouse::find($id);

        $data['house'] = $house;

        return view('warehouse::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){
        if($request->house_id){
            $house = Warehouse::find($request->house_id);
        }else{
            $house = new Warehouse;
        }

        $house->name = $request->name;
        $house->add_line_1 = $request->add_line_1;
        $house->add_line_2 = $request->add_line_2;
        $house->add_line_3 = $request->add_line_3;
        $house->city = $request->city;
        $house->county = $request->county;
        $house->postcode = $request->postcode;
        $house->country_code = $request->country_code;
        $house->phone_number = $request->phone_number;
        $house->email = $request->email;

        if($house->save()){
            alert()->success('Warehouse data updated!')->persistent('Close');
        }else{
            alert()->error('Could not update the data, please try again later!')->persistent('Close');
        }


        return redirect('warehouse');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id = ''){
        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('delete_warehouse', Warehouse::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $house = Warehouse::find($id);

        if($house->delete()){
            alert()->success('Warehouse has been deleted')->persistent('Close');
        }else{
            alert()->error('Could not delete the warehouse data, please try again later!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function add_employee(Request $request){
        $warehouse = Warehouse::find($request->house_id);

        $employee = new WarehouseEmployee;
        $employee->warehouse_id = $warehouse->id;
        $employee->user_id = $request->user_id;
        $employee->role_id = $request->role_id;

        if($employee->save()){
            $status = 'success';
            $msg = $employee->user->name . ' has been added to '. $employee->warehouse->name . ' as a ' . $employee->role->name;
        }else{
            $status = 'error';
            $msg = 'Could not update! Please try again later!';
        }

        return [
            'status' => $status,
            'msg' => $msg,
            'view' => view('warehouse::employees', ['employees' => $warehouse->employees])->render()
        ];
    }

    public function remove_employee($id = ''){
        $employee = WarehouseEmployee::find($id);
        $warehouse = $employee->warehouse;
        $user = $employee->user;
        $role = $employee->role;

        if($employee->delete()){
            alert()->success($user->name . ' has been removed from '. $warehouse->name . ' as a ' . $role->name)->persistent('Close');
        }else{
            alert()->error('Could not update! Please try again later!')->persistent('Close');
        }


        return redirect()->back();

    }

    public function add_external_driver(Request $request){

        if($request->external_driver_id){
            $driver = WarehouseExternalDriver::find($request->external_driver_id);
        }else{
            $driver = new WarehouseExternalDriver;
        }

        $driver->name = $request->driver_name;
        $driver->phone_number = $request->driver_number;
        $driver->email = $request->driver_email;
        $driver->address = $request->driver_address;
        $driver->note = $request->driver_note;

        $driver->warehouse_id = $request->house_id;

        if($driver->save()){
            alert()->success('External driver has been added')->persistent('CLose');
        }else{
            alert()->error('Something went wrong, please try again later')->persistent('Close');
        }

        return redirect('warehouse/show/' . $request->house_id);
    }
    public function delete_external_driver($id){

        $driver = WarehouseExternalDriver::find($id);
        $house = $driver->warehouse;

        if (Gate::denies('manage_external_driver_for_warehouse', $house)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        if($driver->delete()){
            alert()->success('External driver has been deleted from ' . $house->name)->persistent('Close');
        }else{
            alert()->error('Something went wrong, please try again later')->persistent('Close');
        }

        return redirect()->back();
    }

    public function get_drivers(Request $request){
        $house = Warehouse::find($request->warehouse_id);

        $data = array();

        if($request->external_driver){
            $drivers = $house->external_drivers;
            foreach ($drivers as $driver){
                $data[] = ['id' => $driver->id, 'name' => $driver->name];
            }
        }else{

            $roles = Role::where('name', 'like', '%driver%')->get();

            $drivers = $house->employees->whereIn('role_id', $roles->pluck('id'));

            foreach ($drivers as $driver){
                $data[] = ['id' => $driver->user->id, 'name' => $driver->user->name];
            }
        }

        return $data;
    }

    public function assign_pickup(Request $request){
        //return $request->input();

        $posts = CargoPost::whereIn('id', explode(',', $request->posts))->get();

        // update status to cargo_pickups as picked
        CargoPickup::whereIn('cargo_post_id', $posts->pluck('id'))->update(['picked' => 1]);


        $status_id = get_status_id_by_code('to_london');
        foreach ($posts as $post){
            // add new entry to cargo_post_statuses
            $post->statuses()->save(new CargoPostStatus(['status_id' => $status_id]));

            // add history
            $post->histories()->save( new CargoPostHistory( [ 'description' => 'On the way to London Warehouse', 'user_id' => auth()->id() ] ) );

            // update status to cargo_posts as to_london
            $post->status_id = $status_id;
            $post->save();
        }

        // add to warehouse_posts
        $pickup = new WarehousePickup;
        $pickup->warehouse_id = $request->warehouse_id;
        $pickup->date = now();

        if($request->has('external_driver')){
            $pickup->external_driver = true;
            $pickup->external_driver_id = $request->driver_id;
        }else{
            $pickup->external_driver = false;
            $pickup->driver_id = $request->driver_id;
        }

        $pickup->note = $request->note;
        $pickup->status_id = $status_id;
        $pickup->agent_id = $posts->first()->agent_id;
        $pickup->local_status = 0;

        if($request->est_pickup_date){
            $pickup->est_pickup_date = Carbon::createFromFormat('d/m/Y', $request->est_pickup_date);
        }

        if($pickup->save()){
            foreach ($posts as $post){
                $pickup->posts()->save(new WarehousePickupPost(['post_id' => $post->id]));
            }
        }

        alert()->success('Driver has been assigned!')->persistent('Close');

        // return to pickup assigned uri
        return redirect('warehouse/pickup-assigned');
    }

    public function pickup_assigned(){
        $pickups = WarehousePickup::not_picked()->get();

        $data = array();
        $data['pickups'] = $pickups;

        return view('warehouse::pickup-list', $data);
    }

    public function pickup_list($id){
        $pickup = WarehousePickup::find($id);

        $data = array();

        $data['pickup'] = $pickup;
        $data['posts'] = $pickup->posts;

        return view('warehouse::pickup-list-details', $data);
    }

    public function print_pickup_list($id){
        $pickup = WarehousePickup::find($id);

        $data = array();

        $data['pickup'] = $pickup;
        $data['posts'] = $pickup->posts;

        $agent = $pickup->agent;

        $data['agent'] = $agent;


         $logo_content = file_get_contents(base_path('public/img/logo.png'));


        $data['logo'] = $logo_content;

        $options = array(
            'footer-line' => true,
            'margin-bottom' => 20,
            'footer-left' => get_settings('powered_by', 'Powered By: Magic Office Limited'),
            'footer-center' => '',
            'footer-right' => 'Page [page] of [topage]',
            'footer-spacing' => 8,
            'footer-font-size' => 8
        );

        //return view('cargo::invoice', $data);
        return SnappyPdf::loadView('warehouse::print-pickup-list', $data)->setOptions($options)->inline('Pickup-List.pdf');

        //return view('warehouse::pickup-list-details', $data);
    }

    public function login($house_id = ''){

        $user = User::find(auth()->id());

        //if the warehouse ID is given to login, check the if that house is belongs to this user!!
        if($house_id){

            $house = Warehouse::find($house_id);

            if($user->hasRole('admin')){
                // as this is admin, so log in
                session(['house_id' => $house->id]);
                alert()->success('Login to ' . $house->name . ' warehouse!')->persistent('Close');
                return redirect('home');
            }

            // this user is not admin, so check the access rights
            if($result = $user->warehouse_employments->where('warehouse_id', '=', $house_id)->first()){
                // let it login
                session(['house_id' => $result->warehouse_id]);
                alert()->success('Login to ' . $result->warehouse->name . ' warehouse!')->persistent('Close');
                return redirect('home');
            }
        }

        if($user->hasRole('admin')){
            // Admin should be able to login to any warehouse
            return view('warehouse::login', ['admin' => true, 'houses' => Warehouse::all()]);
        }

        if($total = $user->warehouse_employments->count()){
            if($total > 1){
                // there are more than one warehouses. sho show them on screen to login in
                return view('warehouse::login', ['houses' => $user->warehouse_employments]);
            }else{
                // find the warehouse and login straightway
                $house = $user->warehouse_employments->first()->warehouse;
                session(['house_id' => $house->id]);
                alert()->success('Login to ' . $house->name . ' warehouse!')->persistent('Close');
                return redirect('home');
            }
        }

        alert()->error('You do not have access rights to any warehouse!')->persistent('Close');
        return redirect('home');
    }

    public function logout(){
        session(['house_id' => null]);
        alert()->success('Logged out from warehouse!')->persistent('Close');
        return redirect('home');
    }
}
