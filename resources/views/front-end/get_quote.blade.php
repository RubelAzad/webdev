@extends('nec.layouts.page')

@push('style')
    <link href="{{url('front-end/plugins/chosen_v1.8.7/chosen.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{url('front-end/plugins/chosen_v1.8.7/chosen.jquery.min.js')}}"></script>
    <script src="{{url('front-end/js/quote.js')}}"></script>
@endpush

@section('heading')
    Get Quote
@endsection
@section('second-heading')
    Find the approximate cost before you make order
@endsection

@section('breadcrumb')
    <span>Get Quote</span>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Get a quick quote</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['id' => 'frm_get_quote', 'class' => 'form-horizontal']) !!}

            @include('front-end.quote-internal-form')
            {{--@include('front-end.quote-external-form')--}}

            {!! Form::close() !!}
        </div>
    </div>
@endsection