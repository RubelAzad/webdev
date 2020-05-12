@extends('back-end.layouts.app')

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/sent.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-comment-o"></i> Incoming Enquiries
@endsection

@section('breadcrumb')
    <li class="active">Incoming Enquiries</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_enquiries" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>From</th>
                    <th class="center">Date</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th class="center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($enquiries as $enquiry)
                    <tr>
                        <td>{{$enquiry->agent->name}}</td>
                        <td class="center">
                            {{$enquiry->created_at->format('d/m/Y')}}
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
