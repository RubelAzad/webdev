@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:new/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>News</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_news', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/news/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create News</a>
    @endcan
@endsection


@section('page_header')
    News in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_news" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th class="center">Published</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($news->count())
                @foreach($news as $new)
                    <tr>
                        <td><a href="{{url('news/'. $new->slug)}}">{{$new->title}}</a></td>
                        <td>{{$new->slug}}</td>
                        <td class="center"><i class="fa fa-{{$new->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">{{$new->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_news', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/news/edit/' . $new->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/news/delete/' . $new->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
