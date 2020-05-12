@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:slide-show/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Slide Shows</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_slide_shows', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/slide-show/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new slide show</a>
    @endcan
@endsection


@section('page_header')
    Slide shows in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_slide_shows" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th class="center">Image</th>
                <th>Title</th>
                <th>Button 1</th>
                <th>Button 1 link</th>
                <th>Button 2</th>
                <th>Button 2 link</th>
                <th class="center">Published</th>
                <th class="center">Show Info</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($slide_shows->count())
                @foreach($slide_shows as $slide_show)
                    <tr>
                        <td class="center"><img src="{{url('file/serve/'. $slide_show->image)}}" width="150"></td>
                        <td>{{$slide_show->title}}</td>
                        <td>{{$slide_show->button1_text}}</td>
                        <td>{{$slide_show->button1_link}}</td>
                        <td>{{$slide_show->button2_text}}</td>
                        <td>{{$slide_show->button2_link}}</td>
                        <td class="center"><i class="fa fa-{{$slide_show->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">
                            <a class="btn btn-sm btn-primary show_info" href="{{url('site/slide-show/show-info/' . $slide_show->id)}}"><i class="fa fa-{{$slide_show->show_info ? 'check' : 'times'}}"></i></a>
                        </td>
                        <td class="center">{{$slide_show->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_slide_shows', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/slide-show/edit/' . $slide_show->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/slide-show/delete/' . $slide_show->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
