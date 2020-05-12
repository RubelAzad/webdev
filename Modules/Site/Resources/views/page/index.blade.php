@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:page/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Pages</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_pages', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/page/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new page</a>
    @endcan
@endsection


@section('page_header')
    Pages in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_pages" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th class="center">Published</th>
                <th class="center">Front Page</th>
                <th class="center">Featured</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($pages->count())
                @foreach($pages as $page)
                    <tr>
                        <td>{{$page->title}}</td>
                        <td>{{$page->slug}}</td>
                        <td class="center"><i class="fa fa-{{$page->active ? 'check' : 'times'}}"></i></td>
                        <td class="center"><i class="fa fa-{{$page->front_page ? 'check' : 'times'}}"></i></td>
                        <td class="center">
                            @if($page->featured)
                                <i class="fa fa-{{$page->featured ? 'check' : 'times'}}"></i>
                            @else
                                <a href="{{url('site/page/featured/' . $page->id)}}"><i class="fa fa-times"></i></a>
                            @endif
                        </td>
                        <td class="center">{{$page->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_pages', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/page/edit/' . $page->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/page/delete/' . $page->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
