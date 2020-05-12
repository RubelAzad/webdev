<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Gate;
use Modules\Cargo\Entities\CargoPost;
use Modules\Cargo\Entities\CargoPostHistory;
use Modules\Cargo\Entities\CargoPostStatus;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Entities\WarehouseEntry;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        // if not logged in to warehouse, must do now
        if( ! session('house_id')){
            flash()->info('You must login to warehouse')->important();
            return redirect('warehouse/login');
        }

        $warehouse = Warehouse::find(session('house_id'));

        if (Gate::denies('view_warehouse_entries', $warehouse)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['warehouse'] = $warehouse;

        $entries = $warehouse->entries->where('release', '=', null);
        $data['entries'] = $entries;

        return view('warehouse::entry.index', $data);
    }

    public function get_post($tracking_no){

        $warehouse = Warehouse::find(session('house_id'));
        $post = CargoPost::where('tracking_no', '=', $tracking_no)->get()->first();

        return [
            'post_id' => $post->id,
            'tracking_no' => $post->tracking_no,
            'pieces' => $post->packages->count(),
            'status' => $post->current_status->name
        ];
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){

        $warehouse = Warehouse::find(session('house_id'));

        if (Gate::denies('add_warehouse_entries', $warehouse)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['warehouse'] = $warehouse;

        return view('warehouse::entry.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request){

        $warehouse = Warehouse::find(session('house_id'));
        $posts = CargoPost::whereIn('id', $request->posts)->get();

        foreach ($posts as $post){
            $entry = new WarehouseEntry();
            $entry->warehouse_id = $warehouse->id;
            $entry->post_id = $post->id;
            $entry->date = now();
            $entry->entry_by = auth()->id();

            if($entry->save()){

                $new_status = get_status_id_by_code('at_london');
                $post->status_id = $new_status;
                $post->save();

                $post->statuses()->save(new CargoPostStatus(['status_id' => $new_status]));

                $post->histories()->save(new CargoPostHistory(['description' => 'Shipment has been arrived at ' . $warehouse->name, 'user_id' => auth()->id()]));

            }
        }

        return ['status' => 'success', 'msg' => 'Entries has been successfully added to ' . $warehouse->name];

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('warehouse::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('warehouse::edit');
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
}
