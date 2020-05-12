@extends('back-end.layouts.app')

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/subject.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-commenting"></i> Enquiry Subjects
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-commenting"></i> Enquiry Subjects</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_enquiry_subject', \Modules\Enquiry\Entities\EnquirySubject::class)
        <button id="btn_add_subject" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Subject</button>
    @endcan
@endsection


@section('content')
    <div class="container">

        <div id="div_form" class="panel panel-default" style="display: none">
            <div class="panel-heading">
                <h3 id="subject_title" class="panel-title">Create Subject</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['id' => 'frm_subject', 'class' => 'form-horizontal', 'url' => url('enquiry/subject-update')]) !!}
                {!! Form::hidden('subject_id', '', ['id' => 'subject_id']) !!}
                <div class="form-group">
                    {!! Form::label('subject', '*Subject', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
                        {!! Form::text('subject', '', ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer center">
                <button id="btn_save_subject" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                <button id="btn_cancel_subject" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>




        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Enquiry Subjects</h3>
            </div>

            <div class="panel-body no-padding">
                <table id="tbl_subjects" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="center">SN</th>
                        <th>Subject</th>
                        <th class="center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($subjects->count() && $i = 1)
                        @foreach($subjects as $subject)
                            <tr>
                                <td class="center">{{$i++}}</td>
                                <td>{{$subject->text}}</td>
                                <td class="center">
                                    <div class="btn-group" role="group">
                                        @can('edit_enquiry_subject', \Modules\Enquiry\Entities\EnquirySubject::class)
                                            <button data-id="{{$subject->id}}" class="btn btn-warning edit"><i class="fa fa-edit"></i></button>
                                        @endcan
                                        @can('delete_enquiry_subject', \Modules\Enquiry\Entities\EnquirySubject::class)
                                            <a href="{{url('enquiry/subject-delete/'. $subject->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
