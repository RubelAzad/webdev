<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SiteTestimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('manage_testimonials', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $testimonials = SiteTestimonial::all();
        $data['testimonials'] = $testimonials;

        return view('site::testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        if (Gate::denies('manage_testimonials', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::testimonial.create');
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
        if (Gate::denies('manage_testimonials', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $testimonial = SiteTestimonial::find($id);

        return view('site::testimonial.edit', ['testimonial' => $testimonial]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

        if($request->testimonial_id){
            // edit and update
            $testimonial = SiteTestimonial::find($request->testimonial_id);
            $testimonial->editor_id = auth()->id();
        }else{
            // create new testimonial
            $testimonial = new SiteTestimonial;
            $testimonial->author_id = auth()->id();
        }

        $testimonial->text = $request->text;
        $testimonial->name = $request->name;
        $testimonial->occupation = $request->occupation;

        if($request->has('active')){
            $testimonial->active = true;
        }else{
            $testimonial->active = false;
        }

        if($testimonial->save()){
            if($request->has('file')){
                if($testimonial->image){
                    //delete th previous file
                    delete_file_by_hash_final($testimonial->image);
                }

                // add the new file
                $path = 'testimonial/'.$testimonial->id .'/';
                $testimonial->image = save_file_to_db($request, $path);
                $testimonial->save();
            }
            alert()->success('Testimonial Updated!')->persistent('Close');
        }

        return redirect('site/testimonial');
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
        if (Gate::denies('manage_testimonials', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $testimonial = SiteTestimonial::find($id);

        if($testimonial->delete()){
            if($testimonial->image){
                //delete th previous file
                delete_file_by_hash_final($testimonial->image);
            }
            alert()->success('Testimonial has been deleted!')->persistent('Close');
            flash()->success('Testimonial has been deleted!')->important();
        }

        return redirect()->back();
    }
}
