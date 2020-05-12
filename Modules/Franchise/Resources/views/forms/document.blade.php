<div class="modal fade" id="mdl_upload_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Document</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'frm_upload_document', 'url' => url('franchise/add-document'), 'class' => 'form-inline', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('doc_type', 'Document Type', ['class' => 'control-label', 'required' => 'required' ]) !!}
                    {!! Form::select('doc_type', $doc_types, '', ['class' => 'form-control']) !!}
                    {!! Form::file('file', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btn_submit_document" type="button" class="btn btn-primary"><i class="fa fa-upload"></i> Upload This Document</button>
            </div>
        </div>
    </div>
</div>
