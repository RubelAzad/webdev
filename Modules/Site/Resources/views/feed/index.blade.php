@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:feed/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Feeds</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_feeds', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/feed/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new feed</a>
    @endcan
@endsection


@section('page_header')
    Feeds in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_feeds" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Text</th>
                <th>link</th>
                <th class="center">Published</th>
                {{--<th class="center">Expire Date</th>--}}
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($feeds->count())
                @foreach($feeds as $feed)
                    <tr>
                        <td>{{$feed->text}}</td>
                        <td>{{$feed->link}}</td>
                        <td class="center"><i class="fa fa-{{$feed->active ? 'check' : 'times'}}"></i></td>
                        {{--<td class="center">{{$feed->expire ? $feed->expire->format('d/m/Y : H:i'): ''}}</td>--}}
                        <td class="center">{{$feed->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_feeds', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/feed/edit/' . $feed->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/feed/delete/' . $feed->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
