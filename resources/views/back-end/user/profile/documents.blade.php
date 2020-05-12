<div class="panel rounded shadow no-overflow">
    <div class="panel-heading">
        <div class="pull-left">
            <h3 class="panel-title">Documents Details</h3>
        </div>
        <div class="pull-right">
            @can('add_person_file', \Modules\People\Entities\PersonFile::class)
                <button id="btn_add_document" class="btn btn-primary" title="Add New Document"><i class="fa fa-plus"></i> Add Document</button>
            @endcan
        </div>
        <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body no-padding">
        <div id="div_form_document" class="well" style="display: none">
            {!! Form::open(['id' => 'frm_document', 'url' => 'people/document-add', 'files' => true, 'class'=> 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('document_type_id', 'Document Type', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::select('document_type_id', get_file_type_as_select_options(),'', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('file', 'Select a File', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::file('file', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('file_name', 'Friendly Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('file_name', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('file_description', 'Description', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::textarea('file_description', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            {!! Form::hidden('person_id', $user->person->id) !!}

            <div class="form-group">
                <div class="btn-group pull-right" role="group">
                    {!! Form::button('Cancel', ['id' => 'cancel_document_form', 'class' => 'btn btn-default']); !!}
                    {!! Form::submit('Save Change', ['class' => 'btn btn-inverse']); !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <div id="div_form_document_update" class="well" style="display: none">
            {!! Form::open(['id' => 'frm_document_update', 'url' => 'people/document-update', 'files' => true, 'class'=> 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('update_document_type_id', 'Document Type', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::select('update_document_type_id', get_file_type_as_select_options(),'', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('update_file_name', 'File Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('update_file_name', '', ['class' => 'form-control disabled', 'disabled' => 'disabled']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('update_file_new_name', 'Friendly Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('update_file_new_name', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('update_file_description', 'Description', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::textarea('update_file_description', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            {!! Form::hidden('person_id', $user->person->id) !!}
            {!! Form::hidden('document_id', '', array('id' => 'document_id')) !!}

            <div class="form-group">
                <div class="btn-group pull-right" role="group">
                    {!! Form::button('Cancel', ['id' => 'cancel_update_document_form', 'class' => 'btn btn-inverse']); !!}
                    {!! Form::submit('Save Change', ['class' => 'btn btn-inverse']); !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <!-- Start repeater -->
        <table id="tbl_document" class="table table-striped table-bordered table-hover table-condensed" width="100%">
            <thead>
            <tr>
                <th class="text-center">SN</th>
                <th>File Name</th>
                <th>File Type</th>
                <th>Description</th>
                <th class="text-center">Upload Date</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($user->person->files->count() && $i=1)
                @foreach($user->person->files as $file)
                    <tr>
                        <td class="text-center">{{$i++}}</td>
                        <td>{{$file->actual_file->new_name ? $file->actual_file->new_name : $file->actual_file->name}}</td>
                        <td>{{$file->actual_file->type ? $file->actual_file->type->name : ''}}</td>
                        <td>{{$file->actual_file->description}}</td>
                        <td class="text-center">{{$file->created_at->format('d/m/Y')}}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                @can('edit_person_file', $file)
                                    <button id="file-{{$file->id}}" rel="tooltip" title="Edit" class="edit_info btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i></button>
                                @endcan
                                @can('view_person_file', $file)
                                    <button id="{{$file->actual_file->hash}}" rel="tooltip" value="{{$file->actual_file->extension}}" title="Preview" class="btn_viewer btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                                @endcan
                                @can('print_person_file', $file)
                                    <a href="{{url('file/download/'. $file->actual_file->hash)}}" rel="tooltip" title="Download" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                @endcan
                                @can('delete_person_file', $file)
                                    <button id="delete_file-{{$file->id}}" title="Delete" rel="tooltip" class="btn_delete_file btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div><!-- /.panel-body -->
</div><!-- /.panel -->
<!--/ End repeater -->