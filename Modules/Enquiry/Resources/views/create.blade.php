@extends('back-end.layouts.app')

@push('style')
    <style>
        .select2-dropdown, .select2-drop {
            margin-top: 48px;
        }
    </style>
@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/form.js'))}}"></script>

@endpush

@section('page_header')
    <i class="fa fa-commenting"></i> Create New Enquiry
@endsection

@section('breadcrumb')
    @can('view_all_enquiry', \Modules\Enquiry\Entities\Enquiry::class)
        <li class=""><a href="{{url('enquiry')}}"> All Enquiries </a></li>
    @else
        <li><a href="{{url('enquiry')}}">Enquiries</a></li>
    @endif

    @can('view_enquiries_belongs_to_agent', \Modules\Enquiry\Entities\Enquiry::class)
        <li class=""><a href="{{url('enquiry/agent')}}"> Enquiries To Us</a></li>
    @endif

    <li class="active">Create New Enquiry</li>
@endsection


@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create New Enquiry</h3>
            </div>

            <div class="panel-body">
                @include('enquiry::form', ['enquiry' => ''])
            </div>

            <div class="panel-footer center">
                <button id="btn_save_enquiry" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
            </div>
        </div>
    </div>
@endsection
