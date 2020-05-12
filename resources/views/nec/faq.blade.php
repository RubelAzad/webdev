@extends('nec.layouts.page')
@push('scripts')
<script>
    $(function () {
        $('body').scrollspy({ target: '#faq-categories' });
        $('#faq-categories').affix({
            offset: {
                top: 300
            }
        });
    });
</script>
@endpush

@push('style')
<style>
    #faq-categories.affix{
        position: fixed;
        top: 80px;
        z-index: 9999 !important;
        width: 19%;
    }
</style>
@endpush

@section('breadcrumb')
    <span>Help & Support</span>
@endsection

@section('heading')
    {{strtoupper('Help & Support')}}
@endsection

@section('second-heading')
    Some useful information
@endsection

@section('content')
    <div class="row margin-bottom-30">
        <div class="col-md-4 hidden-print hidden-sm hidden-xs">
            <nav id="faq-categories" class="">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Categories</h3></div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($categories as $category)
                                <li class="">
                                    <a href="#cat-{{$category->id}}"><i class="fa fa-{{$category->icon ? $category->icon : 'list'}}"></i> {{title_case($category->name)}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-md-8">
            @foreach($categories as $category)
                <div id="cat-{{$category->id}}" class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-{{$category->icon ? $category->icon : 'list'}}"></i> {{title_case($category->name)}}</h3>
                    </div>
                    <div class="panel-body">
                        @if($faqs = $category->faqs)
                            @foreach($faqs as $faq)
                                <h4>{{$faq->question}}</h4>
                                {!! $faq->answer !!}
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection