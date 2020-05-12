@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:service/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Services</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_services', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/service/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new service</a>
    @endcan
@endsection


@section('page_header')
    Services in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_services" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th class="center">Published</th>
                <th class="center">Front Page</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($services->count())
                @foreach($services as $service)
                    <tr>
                        <td>{{$service->title}}</td>
                        <td>{{$service->slug}}</td>
                        <td class="center"><i class="fa fa-{{$service->active ? 'check' : 'times'}}"></i></td>
                        <td class="center"><i class="fa fa-{{$service->front_page ? 'check' : 'times'}}"></i></td>
                        <td class="center">{{$service->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_services', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/service/edit/' . $service->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/service/delete/' . $service->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
