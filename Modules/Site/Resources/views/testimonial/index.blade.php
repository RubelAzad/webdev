@extends('site::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('site:testimonial/js/index.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li>Testimonials</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_testimonials', \Modules\Site\Entities\Site::class)
        <a href="{{url('site/testimonial/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new testimonial</a>
    @endcan
@endsection


@section('page_header')
    Testimonials in website
@endsection

@section('content')
    <section class="card card-body">
        <table id="table_testimonials" class="table table-bordered table-striped" style="width: 100%">
            <thead>
            <tr>
                <th width="60%">Text</th>
                <th>Name</th>
                <th>Occupation</th>
                <th class="center">Published</th>
                <th class="center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($testimonials->count())
                @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{$testimonial->text}}</td>
                        <td>{{$testimonial->name}}</td>
                        <td>{{$testimonial->occupation}}</td>
                        <td class="center"><i class="fa fa-{{$testimonial->active ? 'check' : 'times'}}"></i></td>
                        <td class="center">
                            @can('manage_testimonials', \Modules\Site\Entities\Site::class)
                                <div class="btn-group" role="group">
                                    <a href="{{url('site/testimonial/edit/' . $testimonial->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('site/testimonial/delete/' . $testimonial->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
