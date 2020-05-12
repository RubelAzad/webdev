<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use Illuminate\Support\Facades\Gate;
use Modules\Site\Entities\SiteFaq;
use Modules\Site\Entities\SiteFaqCategory;

class FaqController extends Controller
{

    public function index(){

        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $faqs = SiteFaq::all();
        $data['faqs'] = $faqs;

        return view('site::faq.index', $data);
    }


    public function create(){
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $data = array();
        $data['categories'] = SiteFaqCategory::active();

        return view('site::faq.create', $data);
    }



    public function edit($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $data = array();
        $data['categories'] = SiteFaqCategory::active();
        $data['faq'] = SiteFaq::find($id);

        return view('site::faq.edit', $data);
    }


    public function update(Request $request){

        if($request->faq_id){
            // edit and update
            $faq = SiteFaq::find($request->faq_id);
            $faq->editor_id = auth()->id();
        }else{
            // create new faq
            $faq = new SiteFaq;
            $faq->author_id = auth()->id();
        }

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->cat_id = $request->cat_id;

        if($request->has('active')){
            $faq->active = true;
        }else{
            $faq->active = false;
        }


        if($faq->save()){
            alert()->success('Faq Updated!')->persistent('Close');
        }

        return redirect('site/faq');
    }


    public function destroy($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $faq = SiteFaq::find($id);

        if($faq->delete()){
            alert()->success('Faq has been deleted!')->persistent('Close');
            flash()->success('Faq has been deleted!')->important();
        }

        return redirect()->back();
    }

    public function cat_index(){

        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $categories = SiteFaqCategory::all();
        $data['categories'] = $categories;

        return view('site::faq.cat.index', $data);
    }


    public function cat_create(){
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        return view('site::faq.cat.create');
    }



    public function cat_edit($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $data = array();
        $category = SiteFaqCategory::find($id);
        $data['cat'] = $category;

        return view('site::faq.cat.edit', $data);
    }


    public function cat_update(Request $request){

        if($request->cat_id){
            // edit and update
            $category = SiteFaqCategory::find($request->cat_id);
        }else{
            // create new faq
            $category = new SiteFaqCategory;
        }

        $category->name = $request->name;
        $category->icon = $request->icon;

        if($request->has('active')){
            $category->active = true;
        }else{
            $category->active = false;
        }

        if($category->save()){
            alert()->success('Faq category has been updated!')->persistent('Close');
        }

        return redirect('site/faq-cat');
    }


    public function cat_destroy($id = ''){
        if (! $id){
            alert()->error('Required Parameter is missing!')->persistent('close');
            flash()->error('Required Parameter is missing!')->important();
            return redirect()->back();
        }
        if (Gate::denies('manage_faqs', Site::class)){
            alert()->error('Access Denied!')->persistent('close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }
        $category = SiteFaqCategory::find($id);

        if($category->delete()){
            alert()->success('Faq category has been deleted!')->persistent('Close');
            flash()->success('Faq category has been deleted!')->important();
        }

        return redirect()->back();
    }
}
