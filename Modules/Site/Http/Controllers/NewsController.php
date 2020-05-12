<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SiteNews;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_news', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $news = SiteNews::all()->sortByDesc('id');
        $data['news'] = $news;

        return view('site::new.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_news', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::new.create');
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
        if (Gate::denies('manage_news', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $new = SiteNews::find($id);

        return view('site::new.edit', ['new' => $new]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->news_id){
            // edit and update
            $new = SiteNews::find($request->news_id);
            $new->editor_id = auth()->id();
        }else{
            // create new new
            $new = new SiteNews;
            $new->author_id = auth()->id();
        }

        $new->title = $request->title;
        $new->slug = str_slug($request->title, '-');
        $new->body = $request->body;

        if($request->has('active')){
            $new->active = true;
        }else{
            $new->active = false;
        }


        if($new->save()){
            if($request->has('file')){
                if($new->image){
                    //delete th previous file
                    delete_file_by_hash_final($new->image);
                }

                // add the new file
                $path = 'service/'.$new->id .'/';
                $new->image = save_file_to_db($request, $path);
                $new->save();
            }
            alert()->success('News Updated!')->persistent('Close');
        }

        return redirect('site/news');
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
        if (Gate::denies('manage_news', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $new = SiteNews::find($id);

        if($new->delete()){
            if($new->image){
                //delete th previous file
                delete_file_by_hash_final($new->image);
            }
            alert()->success('News has been deleted!')->persistent('Close');
            flash()->success('News has been deleted!')->important();
        }

        return redirect()->back();
    }
}
