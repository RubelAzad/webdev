@extends('service::layouts.master')

@push('style')
    <link rel="stylesheet" href="{{url(Module::asset('service:css/form.css'))}}">
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/valuable/form.js'))}}"></script>
<script>
    let commission_for_agent = '{{get_settings('valuable_commission_agent', 0)}}';
    let commission_for_franchise = '{{get_settings('valuable_commission_franchise', 0)}}';
</script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Edit Valuable Item
@endsection

@section('breadcrumb')
    <li><a href="{{url('service/valuable')}}"><i class="fa fa-cogs"></i> Valuable Items</a></li>
    <li class="active"> Edit Valuable Item</li>
@endsection


@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                @include('service::valuable.form', ['valuable' => $valuable])
            </div>
        </div>
    </div>
@stop
