@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:partner/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Partners</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_partners', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/partner/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new partner</a>
    @endcan
@endsection


@section('page_header')
    Partners in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_partners" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>link</th>
                <th class="center">Logo</th>
                <th class="center">Published</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($partners->count())
                @foreach($partners as $partner)
                    <tr>
                        <td>{{$partner->name}}</td>
                        <td>{{$partner->link}}</td>
                        <td class="center"><img src="{{url('file/serve/' . $partner->logo)}}" style="width: 200px"></td>
                        <td class="center"><i class="fa fa-{{$partner->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">{{$partner->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_partners', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/partner/edit/' . $partner->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/partner/delete/' . $partner->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
