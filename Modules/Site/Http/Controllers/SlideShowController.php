<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use DB;
use Modules\Site\Entities\SiteSlideShow;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_slide_shows', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $slide_shows = SiteSlideShow::all();
        $data['slide_shows'] = $slide_shows;

        return view('site::slide-show.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_slide_shows', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::slide-show.create');
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
        if (Gate::denies('manage_slide_shows', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $slide_show = SiteSlideShow::find($id);

        return view('site::slide-show.edit', ['slide_show' => $slide_show]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){


        if($request->slide_show_id){
            // edit and update
            $slide_show = SiteSlideShow::find($request->slide_show_id);
            $slide_show->editor_id = auth()->id();
        }else{
            // create new slide_show
            $slide_show = new SiteSlideShow;
            $slide_show->author_id = auth()->id();
        }

        $slide_show->title = $request->title;
        $slide_show->description = $request->description;
        $slide_show->button1_text = $request->button1_text;
        $slide_show->button1_link = $request->button1_link;
        $slide_show->button2_text = $request->button2_text;
        $slide_show->button2_link = $request->button2_link;

        if($request->has('active')){
            $slide_show->active = true;
        }else{
            $slide_show->active = false;
        }

        if($slide_show->save()){
            if($request->has('file')){
                if($slide_show->image){
                    //delete th previous file
                    delete_file_by_hash_final($slide_show->image);
                }

                // add the new file
                $path = 'slide_show/'.$slide_show->id .'/';
                $slide_show->image = save_file_to_db($request, $path);
                $slide_show->save();
            }
            alert()->success('Slide show Updated!')->persistent('Close');
        }

        return redirect('site/slide-show');
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
        if (Gate::denies('manage_slide_shows', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $slide_show = SiteSlideShow::find($id);

        if($slide_show->delete()){
            if($slide_show->image){
                //delete th previous file
                delete_file_by_hash_final($slide_show->image);
            }
            alert()->success('Slide show has been deleted!')->persistent('Close');
            flash()->success('Slide show has been deleted!')->important();
        }

        return redirect()->back();
    }

    public function show_info($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_slide_shows', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $slide = SiteSlideShow::find($id);

        if($slide->show_info){
            $slide->show_info = 0;
        }else{
            $slide->show_info = 1;
        }

        if($slide->save()){
            flash()->success('Slide show has been updated!')->important();
        }

        return redirect()->back();
    }
}
