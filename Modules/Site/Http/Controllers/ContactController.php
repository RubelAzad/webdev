<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\ContactUs;
use DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function ServiceIndex()
    {
        if (Gate::denies('manage_contact', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        /* $data = array();
        $contactall = ContactUs::all();
        $data['contactall'] = $contactall;

        return view('site::contact.index', $data); */

        return view('site::contact.index');
    }

     
     
     function getServiceData(){

         $result=ContactUs::all();
         return $result;
     }
     
     
     

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        
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
}
