@extends('back-end.layouts.app')

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/sent.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-comment-o"></i> Enquiries Sent
@endsection

@section('breadcrumb')
    @can('view_all_enquiry', \Modules\Enquiry\Entities\Enquiry::class)
        <li class=""><a href="{{url('enquiry')}}"> <i class="fa fa-comment-o"></i> All Enquiries </a></li>
    @endif
    <li class="active"><i class="fa fa-comment-o"></i> Enquiries to Us</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_enquiries" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">Date & Time</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th class="center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($enquiries as $enquiry)
                    <tr>
                        <td class="center">
                            {{$enquiry->created_at->format('d/m/Y : H:i')}}
                        </td>
                        <td>{{$enquiry->subject->text}}</td>
                        <td>{{str_limit($enquiry->message, 20, '...')}}</td>
                        <td class="center">
                            @if($enquiry->attachments)
                                <i class="fa fa-paperclip fa-lg"></i>
                            @endif
                            <a href="{{url('enquiry/internal-show/'. $enquiry->id)}}" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
