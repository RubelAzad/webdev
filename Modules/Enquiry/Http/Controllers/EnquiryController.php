<?php

namespace Modules\Enquiry\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Gate;
use Modules\Agent\Entities\Agent;
use Modules\Enquiry\Entities\Enquiry;
use Modules\Enquiry\Entities\EnquiryAgent;
use Modules\Enquiry\Entities\EnquiryReply;
use Modules\Enquiry\Entities\EnquiryStatus;
use Modules\Enquiry\Notifications\EnquiryReceived;
use Modules\Enquiry\Notifications\EnquiryReplied;
use Storage;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        if (Gate::denies('view_all_enquiry', Enquiry::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $enquiries = Enquiry::all();

        $data['enquiries'] = $enquiries;

        return view('enquiry::index', $data);
    }

    public function create(){
        $data = array();

        $enquiry = '';

        $data['enquiry'] = $enquiry;

        return view('enquiry::create', $data);
    }

    public function update(Request $request){

        $enquiry = new EnquiryAgent;

        $enquiry->subject_id = $request->subject_id;
        $enquiry->message = $request->message;
        $enquiry->user_id = auth()->id();
        $enquiry->status_id = 1;

        if($request->agent_id){
            $enquiry->agent_id = $request->agent_id;
            $enquiry->to_agent = true;
        }else{
            $enquiry->agent_id = session('agent');
        }

        $attachments = array();

        if($enquiry->save()){

            if ($request->hasFile('attachments')) {
                $path = 'enquiries/' . $enquiry->id;

                foreach ($request->file('attachments') as $attachment){

                    $filename = $attachment->store($path);

                    $path = $path.'/';

                    $file = new \App\File;

                    $file->hash = str_replace($path, '', $filename);
                    $file->name = $attachment->getClientOriginalName();
                    $file->mimetype = Storage::mimeType($filename);
                    $file->extension = $attachment->getClientOriginalExtension();
                    $file->disk = config('filesystems.default');
                    $file->path = $path;

                    $file->uploaded_by = auth()->id();

                    if($file->save()){
                        $attachments[] = $file->id;
                    }
                }

                $enquiry->attachments = implode(',', $attachments);

                $enquiry->save();
            }

            alert()->success('Enquiry has been update');
        }

       return redirect('enquiry/sent');

    }

    public function incoming_enquiries(){


        $data = array();

        if($current_agent = session('agent')){
            $agent = Agent::find($current_agent);
            $enquiries = EnquiryAgent::where('agent_id', $agent->id)->where('to_agent', 1)->get();
            $view = 'enquiry::incoming-enquiries';
        }else{
            $enquiries = EnquiryAgent::where('to_agent', 0)->get();
            $view = 'enquiry::incoming-enquiries-ho';
        }

        $data['enquiries'] = $enquiries;

        return view($view, $data);
    }

    public function sent_enquiries(){


        $data = array();

        if($current_agent = session('agent')){
            $agent = Agent::find($current_agent);
            $enquiries = $agent->sent_enquiries;
            $view = 'enquiry::sent-enquiries';
        }else{
            $enquiries = EnquiryAgent::where('to_agent', 1)->get();
            $view = 'enquiry::sent-enquiries-ho';
        }


        $data['enquiries'] = $enquiries;

        return view($view, $data);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function internal_show($id =''){

        $data = array();

        $enquiry = EnquiryAgent::find($id);

        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('Close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        $data['enquiry'] = $enquiry;

        $agents = Agent::active()->select('id', 'name', 'country', 'city')->get()->groupBy(['country', 'city'], $preserveKeys = true);

        $data['agents'] = $agents;

        $replies = EnquiryAgent::where('parent', $enquiry->id)->get();
        $data['replies'] = $replies;
        $data['statuses'] = EnquiryStatus::all();

        return view('enquiry::internal-show', $data);
    }

    public function internal_reply(Request $request){


        $enquiry = new EnquiryAgent;

        $enquiry->message = $request->message;
        $enquiry->user_id = auth()->id();
        $enquiry->parent = $request->enquiry_id;

        if( ! session('agent')){
            $enquiry->to_agent = true;
        }

        $attachments = array();

        if($enquiry->save()){

            if ($request->hasFile('attachments')) {
                $path = 'enquiries/' . $enquiry->id;

                foreach ($request->file('attachments') as $attachment){

                    $filename = $attachment->store($path);

                    $path = $path.'/';

                    $file = new \App\File;

                    $file->hash = str_replace($path, '', $filename);
                    $file->name = $attachment->getClientOriginalName();
                    $file->mimetype = Storage::mimeType($filename);
                    $file->extension = $attachment->getClientOriginalExtension();
                    $file->disk = config('filesystems.default');
                    $file->path = $path;

                    $file->uploaded_by = auth()->id();

                    if($file->save()){
                        $attachments[] = $file->id;
                    }
                }

                $enquiry->attachments = implode(',', $attachments);

                $enquiry->save();
            }


        }


        return ['status' => true];
    }

    public function internal_update_status(Request $request){
        $enquiry = EnquiryAgent::find($request->enquiry_id);
        $status = EnquiryStatus::find($request->status_id);

        $enquiry->status_id = $request->status_id;

        $enquiry->save();

        return ['status' => true, 'new_status' => $status->name];
    }

    public function agent_enquiries(){

        if (Gate::denies('view_enquiries_belongs_to_agent', Enquiry::class)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data = array();

        $current_agent = session('agent');
        $agent = Agent::find($current_agent);

        $enquiries = $agent->enquiries;

        $data['enquiries'] = $enquiries;

        return view('enquiry::agent-enquiries', $data);
    }



    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id =''){

        $data = array();

        $enquiry = Enquiry::find($id);

        if( ! $id ){
            alert()->error('Required parameter is missing!')->persistent('Close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }

        if (Gate::denies('view_enquiry_details', $enquiry)){
            alert()->error('Access Denied!')->persistent('Close');
            flash()->error('Access Denied!')->important();
            return redirect()->back();
        }

        $data['enquiry'] = $enquiry;

        $agents = Agent::active()->select('id', 'name', 'country', 'city')->get()->groupBy(['country', 'city'], $preserveKeys = true);

        $data['agents'] = $agents;

        return view('enquiry::show', $data);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function view($link =''){

        $data = array();
        $enquiry = Enquiry::where('link', '=', $link)->get()->first();

        if( ! $link  || ! $enquiry){
            alert()->error('Required parameter is missing!')->persistent('Close');
            flash()->error('Required parameter is missing!')->important();
            return redirect()->back();
        }


        $data['enquiry'] = $enquiry;

        $agents = Agent::active()->select('id', 'name', 'country', 'city')->get()->groupBy(['country', 'city'], $preserveKeys = true);

        $data['agents'] = $agents;

        return view('enquiry::show', $data);
    }


    public function assign_to_agent(Request $request){
        $enquiry = Enquiry::find($request->enquiry_id);
        $agent = Agent::find($request->agent_id);

        $agent->enquiries()->attach($enquiry->id);

        // send notification to agent
        $agent->notify(new EnquiryReceived($enquiry));


        return ['status' => true];
    }

    public function reply(Request $request){
        $enquiry = Enquiry::find($request->enquiry_id);

        $reply = new EnquiryReply;
        $reply->message = $request->message;
        $reply->user_id = auth()->id();

        if($enquiry->replies()->save($reply)){
            // notify to customer
            $enquiry->notify(new EnquiryReplied($enquiry, $reply));
            return ['status' => true];

        }else{
            return ['status' => false];
        }
    }
}
