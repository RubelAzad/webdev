@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:faq/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Faqs</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_faqs', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/faq-cat')}}" class="btn btn-primary"><i class="fa fa-sitemap"></i> Faq Category</a>
        <a href="{{url('site/faq/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new faq</a>
    @endcan
@endsection


@section('page_header')
    Faqs in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_faqs" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th class="center">Category</th>
                <th class="center">Published</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($faqs->count())
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{$faq->question}}</td>
                        <td>{!! $faq->answer !!}</td>
                        <td class="center">{{$faq->cat ? $faq->cat->name : ''}}</td>
                        <td class="center"><i class="fa fa-{{$faq->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">{{$faq->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_faqs', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/faq/edit/' . $faq->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/faq/delete/' . $faq->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </section>
@stop
