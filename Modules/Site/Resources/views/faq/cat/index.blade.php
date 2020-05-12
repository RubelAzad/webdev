@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:faq/cat/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Categories</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_faqs', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/faq-cat/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new category</a>
    @endcan
@endsection


@section('page_header')
    Categories in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_cats" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th>Name</th>
                <th class="center">Icon</th>
                <th class="center">Published</th>
                <th class="center">Last Modified</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($categories->count())
                @foreach($categories as $cat)
                    <tr>
                        <td>{{$cat->name}}</td>
                        <td class="center"><i class="fa fa-2x fa-{{$cat->icon}}"></i> </td>
                        <td class="center"><i class="fa fa-2x fa-{{$cat->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">{{$cat->updated_at->format('d/m/Y : H:i')}}</td>
                        <td class="center">
                            @can('manage_faqs', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/faq-cat/edit/' . $cat->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/faq-cat/delete/' . $cat->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
