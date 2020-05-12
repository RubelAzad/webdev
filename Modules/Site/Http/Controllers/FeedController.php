<?php

namespace Modules\Site\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SiteFeed;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_feeds', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $feeds = SiteFeed::all();
        $data['feeds'] = $feeds;

        return view('site::feed.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_feeds', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::feed.create');
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
        if (Gate::denies('manage_feeds', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $feed = SiteFeed::find($id);

        return view('site::feed.edit', ['feed' => $feed]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->feed_id){
            // edit and update
            $feed = SiteFeed::find($request->feed_id);
        }else{
            // create new feed
            $feed = new SiteFeed;
        }

        $feed->text = $request->title;
        $feed->link = $request->link;
//        $feed->expire = $request->expire ? Carbon::createFromFormat('d/m/Y', $request->expire) : null;

        if($request->has('active')){
            $feed->active = true;
        }else{
            $feed->active = false;
        }


        if($feed->save()){
            alert()->success('Feed Updated!')->persistent('Close');
        }

        return redirect('site/feed');
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
        if (Gate::denies('manage_feeds', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $feed = SiteFeed::find($id);

        if($feed->delete()){
            alert()->success('Feed has been deleted!')->persistent('Close');
            flash()->success('Feed has been deleted!')->important();
        }

        return redirect()->back();
    }
}
