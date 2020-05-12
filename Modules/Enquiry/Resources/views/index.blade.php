@extends('back-end.layouts.app')

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/enquiries.js'))}}"></script>

    <script type="application/javascript">

    </script>
@endpush

@section('page_header')
    <i class="fa fa-comment-o"></i> Enquiries
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-comment-o"></i> Enquiries</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('enquiry::table', ['enquiries' => $enquiries])
        </div>
    </div>
@endsection
