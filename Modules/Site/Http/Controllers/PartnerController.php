<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SitePartner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_partners', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $partners = SitePartner::all();
        $data['partners'] = $partners;

        return view('site::partner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_partners', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::partner.create');
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
        if (Gate::denies('manage_partners', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $partner = SitePartner::find($id);

        return view('site::partner.edit', ['partner' => $partner]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->partner_id){
            // edit and update
            $partner = SitePartner::find($request->partner_id);
            $partner->editor_id = auth()->id();
        }else{
            // create new partner
            $partner = new SitePartner;
            $partner->author_id = auth()->id();
        }

        $partner->name = $request->name;
        $partner->link = $request->link ? $request->link : null;


        if($request->has('active')){
            $partner->active = true;
        }else{
            $partner->active = false;
        }


        if($partner->save()){
            if($request->has('file')){
                if($partner->logo){
                    //delete th previous file
                    delete_file_by_hash_final($partner->logo);
                }

                // add the new file
                $path = 'partner/'.$partner->id .'/';
                $partner->logo = save_file_to_db($request, $path);
                $partner->save();
            }
            alert()->success('Partner Updated!')->persistent('Close');
        }

        return redirect('site/partner');
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
        if (Gate::denies('manage_partners', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $partner = SitePartner::find($id);

        if($partner->delete()){
            if($partner->logo){
                //delete th previous file
                delete_file_by_hash_final($partner->logo);
            }
            alert()->success('Partner has been deleted!')->persistent('Close');
            flash()->success('Partner has been deleted!')->important();
        }

        return redirect()->back();
    }
}
