@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:testimonial/js/form.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/testimonial')}}">Testimonials</a></li>
    <li>Create new testimonial</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Create New Testimonial</h1></div>
    <div class="panel-body">
        @include('site::testimonial.form', ['testimonial' => ''])
    </div>
    <div class="panel-footer">
        <button id="btn_save_testimonial" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection