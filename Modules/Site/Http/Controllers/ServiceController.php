<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SiteService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_services', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $services = SiteService::all();
        $data['services'] = $services;

        return view('site::service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_services', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::service.create');
    }

    
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_services', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $service = SiteService::find($id);

        return view('site::service.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->service_id){
            // edit and update
            $service = SiteService::find($request->service_id);
            $service->editor_id = auth()->id();
        }else{
            // create new service
            $service = new SiteService;
            $service->author_id = auth()->id();
        }

        $service->title = $request->title;
        $service->slug = str_slug($request->title, '-');
        $service->summary = $request->summary;
        $service->body = $request->body;
        $service->icon = $request->icon;

        if($request->has('active')){
            $service->active = true;
        }else{
            $service->active = false;
        }

        if($request->has('front_page')){
            $service->front_page = true;
        }else{
            $service->front_page = false;
        }

        if($service->save()){
            if($request->has('file')){
                if($service->image){
                    //delete th previous file
                    delete_file_by_hash_final($service->image);
                }

                // add the new file
                $path = 'service/'.$service->id .'/';
                $service->image = save_file_to_db($request, $path);
                $service->save();
            }
            alert()->success('Service Updated!')->persistent('Close');
        }

        return redirect('site/service');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_services', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $service = SiteService::find($id);

        if($service->delete()){
            if($service->image){
                //delete th previous file
                delete_file_by_hash_final($service->image);
            }
            alert()->success('Service has been deleted!')->persistent('Close');
            flash()->success('Service has been deleted!')->important();
        }

        return redirect()->back();
    }
    
}
