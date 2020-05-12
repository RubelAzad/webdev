<?php

namespace Modules\Enquiry\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Gate;
use Modules\Enquiry\Entities\EnquirySubject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(EnquirySubject $subjects){
        if (Gate::denies('view_enquiry_subject', EnquirySubject::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();
        $data['subjects'] = $subjects->get();

        return view('enquiry::subject.index', $data);
    }


    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){
        if($request->subject_id){
            $subject = EnquirySubject::find($request->subject_id);
        }else{
            $subject = new EnquirySubject;
        }

        $subject->text = $request->subject;

        if($subject->save()){
            alert()->success('Subject has been updated!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function get_subject($id){
        $subject = EnquirySubject::find($id);

        return $subject;
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id){
        if (Gate::denies('delete_enquiry_subject', EnquirySubject::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $subject = EnquirySubject::find($id);

        if($subject->delete()){
            alert()->success('Subject has been deleted!')->persistent('Close');
        }

        return redirect()->back();
    }
}
