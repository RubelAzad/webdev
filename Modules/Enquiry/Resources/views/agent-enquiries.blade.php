@extends('back-end.layouts.app')

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/enquiries.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-comment-o"></i> Enquiries
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
            @include('enquiry::table', ['enquiries' => $enquiries])
        </div>
    </div>
@endsection
