<div class="row">
    @if($draft && $draft->packages)
        <div id="div_document" class="col-sm-3 well well-sm cargo-type padding-5" style="display:{{$draft->doc ? 'auto' : 'none'}}; height: 100px ">
            <span class="col-lg-3 center"><img src="{{url(Module::asset('cargo:img/letter.png'))}}" class="img-thumbnail img-responsive center" style="width: 80px"></span>
            <span class="col-lg-6 center"><h3>Document</h3></span>
            <span class="col-lg-3 center"><p id="document_checked" class="text-success" style="display: none"><i class="fa fa-check fa-3x"></i></p></span>
        </div>
        <div id="div_parcel" class="col-sm-3 well well-sm cargo-type padding-5" style="display:{{ ! $draft->doc ? 'auto' : 'none'}};height: 100px">
            <span class="col-lg-3 center"><img src="{{url(Module::asset('cargo:img/box.png'))}}" class="img-thumbnail img-responsive center" style="width: 80px"></span>
            <span class="col-lg-6 center"><h3>Non-Document</h3></span>
            <span class="col-lg-3 center"><p id="parcel_checked" class="text-success" style="display: none"><i class="fa fa-check fa-3x"></i></p></span>
        </div>
    @else
        <div id="div_document" class="col-sm-3 well well-sm cargo-type padding-5" style="height: 100px">
            <span class="col-lg-3 center"><img src="{{url(Module::asset('cargo:img/letter.png'))}}" class="img-thumbnail img-responsive center" style="width: 80px"></span>
            <span class="col-lg-6 center"><h3>Document</h3></span>
            <span class="col-lg-3 center"><p id="document_checked" class="text-success" style="display: none"><i class="fa fa-check fa-3x"></i></p></span>
        </div>
        <div id="div_parcel" class="col-sm-3 well well-sm cargo-type padding-5" style="height: 100px">
            <span class="col-lg-3 center"><img src="{{url(Module::asset('cargo:img/box.png'))}}" class="img-thumbnail img-responsive center" style="width: 80px"></span>
            <span class="col-lg-6 center"><h3>Non-Document</h3></span>
            <span class="col-lg-3 center"><p id="parcel_checked" class="text-success" style="display: none"><i class="fa fa-check fa-3x"></i></p></span>
        </div>
    @endif

    <div class="col-sm-5 pull-right">
        <div class="panel panel-info">
            <div class="panel-body">
                {!! Form::open(['id' => 'frm_pkg_des','class' => 'form-horizontal', 'url' => url('#')]) !!}
                <div class="form-group">
                    {!! htmlspecialchars_decode(Form::label('description', '<span class="star">*</span>Package Description', ['class' => 'col-md-3 control-label'])) !!}
                    <div class="col-md-9">
                        {!! Form::text('description', $draft ? $draft->description : '', ['class' => 'form-control', 'rows' => 2, 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! htmlspecialchars_decode(Form::label('declare_value', '<span class="star">*</span>Declare Value', ['class' => 'col-md-3 control-label'])) !!}
                    <div class="col-md-9">
                        {!! Form::number('declare_value', $draft ? $draft->value : '', ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

{!! Form::open(['id' => 'frm_add_doc', 'class' => 'form-inline', 'url' => url('cargo/add-package')]) !!}
<div id="document_fields" class="panel panel-default" style="display: none">
    <div class="panel-body no-padding table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Package Type</th>
                <th>Quantity</th>
                <th>Weight</th>
                <th>Total Weight</th>
                <th class="center">Add</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{!! Form::select('type',$package_types->where('code', 'DOC')->pluck('name', 'id')->prepend('',''), '', ['class' => 'form-control', 'required' => 'required']) !!}</td>
                <td>{!! Form::number('quantity', '', ['class' => 'form-control', 'id' => 'doc_quantity', 'min' => 1, 'required' => 'required']) !!}</td>
                <td>{!! Form::text('weight', '', ['class' => 'form-control', 'id' => 'doc_weight', 'required' => 'required']) !!}kg</td>
                <td><span id="doc_total_weight"></span></td>
                <td class="center"><button id="add-package-document" class="btn btn-sm btn-primary disabled"><i class="fa fa-arrow-down"></i></button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
{!! Form::close() !!}

{!! Form::open(['id' => 'frm_add_parcel', 'class' => 'form-inline', 'url' => url('cargo/add-package')]) !!}
<div id="parcel_fields" class="panel panel-default" style="display: none">
    <div class="panel-body no-padding table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Package Type</th>
                <th>Quantity</th>
                <th>Weight</th>
                <th>Length</th>
                <th>Width</th>
                <th>Height</th>
                <th>Volume</th>
                <th>Total Weight</th>
                <th class="center">Add</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{!! Form::select('type', $package_types->where('code', '!=', 'DOC')->pluck('name', 'id')->prepend('',''), '', ['class' => 'form-control', 'required' => 'required']) !!}</td>
                <td>{!! Form::number('quantity', '', ['class' => 'form-control', 'id' => 'parcel_quantity', 'min' => 1, 'required' => 'required']) !!}</td>
                <td>{!! Form::text('weight', '', ['class' => 'form-control', 'id' => 'parcel_weight', 'width'=>'50px', 'required' => 'required']) !!}kg</td>
                <td>{!! Form::text('length', '', ['class' => 'form-control', 'id' => 'parcel_length']) !!}cm</td>
                <td>{!! Form::text('width', '', ['class' => 'form-control', 'id' => 'parcel_width']) !!}cm</td>
                <td>{!! Form::text('height', '', ['class' => 'form-control', 'id' => 'parcel_height']) !!}cm</td>
                <td class="center"><span id="parcel_volume_weight"></span></td>
                <td class="center"><span id="parcel_total_weight"></span></td>
                <td class="center"><button id="add-package-parcel" class="btn btn-sm btn-primary disabled"><i class="fa fa-arrow-down"></i></button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
{!! Form::close() !!}
