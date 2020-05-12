<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Modules\Site\Entities\SitePage;
use Gate;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_pages', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $pages = SitePage::all();
        $data['pages'] = $pages;

        return view('site::page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_pages', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::page.create');
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
        if (Gate::denies('manage_pages', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $page = SitePage::find($id);

        return view('site::page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->page_id){
            // edit and update
            $page = SitePage::find($request->page_id);
            $page->editor_id = auth()->id();
        }else{
            // create new page
            $page = new SitePage;
            $page->author_id = auth()->id();
        }

        $page->title = $request->title;
        $page->slug = str_slug($request->slug, '-');
        $page->summary = $request->summary;
        $page->body = $request->body;

        if($request->has('active')){
            $page->active = true;
        }else{
            $page->active = false;
        }

        if($request->has('front_page')){
            $page->front_page = true;
        }else{
            $page->front_page = false;
        }

        if($page->save()){
            if($request->has('file')){
                if($page->image){
                    //delete th previous file
                    delete_file_by_hash_final($page->image);
                }

                // add the new file
                $path = 'page/'.$page->id .'/';
                $page->image = save_file_to_db($request, $path);
                $page->save();
            }
            alert()->success('Page Updated!')->persistent('Close');
        }

        return redirect('site/page');
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
        if (Gate::denies('manage_pages', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $page = SitePage::find($id);

        if($page->delete()){
            if($page->image){
                //delete th previous file
                delete_file_by_hash_final($page->image);
            }
            alert()->success('Page has been deleted!')->persistent('Close');
            flash()->success('Page has been deleted!')->important();
        }

        return redirect()->back();
    }

    public function featured($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_pages', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $page = SitePage::find($id);

        //update all the pages as not featured
        DB::table('site_pages')->update(['featured' => 0]);

        $page->featured = 1;

        if($page->save()){
            flash()->success('New featured page has been updated!')->important();
        }

        return redirect()->back();
    }
}
