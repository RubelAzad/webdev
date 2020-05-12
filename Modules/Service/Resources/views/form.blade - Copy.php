@push('style')
    <style>
        input[type=radio] + .details{
            display: none;
        }

        input[type=radio]:checked + .fordebit {
            display: block;
        }

        input[type=radio]:checked + .forcredit {
            display: inline-block;
        }
        input[type=radio]:checked + .forcard {
            display: block;
        }
        input[type=radio] {
            float:left;
            margin-top: 6px;
            margin-right: 10px;
        }
        .float-left {
            display: inline-block;
        }
    </style>
@endpush
@push('scripts')

    <script type="text/javascript">

        var i = 0;

        $("#add").click(function(){

            ++i;

            $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Minimun Kg" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Maximun Kg" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Charge" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

    </script>

@endpush

{!! Form::open(['id' => 'frm_service', 'url' => url('service/update'), 'class' => 'form-horizontal']) !!}
{!! Form::hidden('service_id', $service ? $service->id : '', ['id' => 'service_id']) !!}
<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::text('name', $service ? $service->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                {!! Form::textarea('description', $service ? $service->description : '', ['class' => 'form-control', 'rows' => 2]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('provider_id', '<span class="star">*</span>Provider', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                @if($provider)
                    {!! Form::select('provider_id', $providers->pluck('name', 'id')->prepend('', ''), $provider ? $provider->id : '', ['class' => 'form-control', 'required' => 'required']) !!}
                @else
                    {!! Form::select('provider_id', $providers->pluck('name', 'id')->prepend('', ''), $service ? $service->provider_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('src_country', '<span class="star">*</span>Source Country', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                @if($country)
                    {!! Form::select('src_country', get_countries_for_select(), $country ? $country->iso_3166_3 : '', ['class' => 'form-control select2', 'required' => 'required',]) !!}
                @else
                    {!! Form::select('src_country', get_countries_for_select(), $service ? $service->src_country : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
                @endif
            </div>
        </div>
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('dst_country', '<span class="star">*</span>Destination Country', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::select('dst_country', get_countries_for_select(), $service ? $service->dst_country : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('item_type', '<span class="star">*</span>Item Type', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::select('item_type', ['1' => 'Document', '2'=> 'Non-Document'], $service ? $service->item_type : '1', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <!-- <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('minimum_weight', '<span class="star">*</span>Minimum Weight', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::number('minimum_weight', $service ? $service->minimum_weight : '', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('maximum_weight', '<span class="star">*</span>Maximum Weight', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::number('maximum_weight', $service ? $service->maximum_weight : '', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('price', '<span class="star">*</span>Unit Price/kg', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::number('price', $service ? $service->price : '', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('base_price', '<span class="star">*</span>Base Price', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::number('base_price', $service ? $service->base_price : '0', ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('commission', '<span class="star">*</span>Commission %', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                {!! Form::number('commission', $service ? $service->commission : 0, ['class' => 'form-control', 'min' => 0, 'max' => '100', 'required' => 'required']) !!}
            </div>
        </div> -->
        <div class="form-group">
            {!! htmlspecialchars_decode(Form::label('fixed', '<span class="star">*</span>Fixed', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                <input type="radio" name="base_price" id="credit" value="fixed">
                <div class="forcredit details">
                    <input type="text" name="fixednum">
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('slab', '<span class="star">*</span>Slab ', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8">
                <input type="radio" name="base_price" id="card" value="slab">
                <div class="forcard details">
                <table class="table table-bordered" id="dynamicTable">
                    <tr>
                        <th>Minimun Kg</th>
                        <th>Maximun Kg</th>
                        <th>Charge</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="addmore[0][minimum_weight]" placeholder="Minimun Kg" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][maximum_weight]" placeholder="Maximun Kg" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][price]" placeholder="Charge" class="form-control" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>

    </div>
    </div>
  <!--   <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title text-center"><strong>Calculation</strong></h3></div>
            <div class="panel-body no-padding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Base Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Head Office</th>
                        <td class="text-center"><span id="ho_unit_price"></span></td>
                        <td class="text-center"><span id="ho_base_price"></span></td>
                    </tr>
                    <tr>
                        <th>Commission</th>
                        <td class="text-center"><span id="commission_unit_price"></span></td>
                        <td class="text-center"><span id="commission_base_price"></span></td>
                    </tr>
                    <tr>
                        <th>Final</th>
                        <td class="text-center"><span id="sales_unit_price"></span></td>
                        <td class="text-center"><span id="sales_base_price"></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <p class="text-info">
                    <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> 100% of commission will be assigned to Franchise. Later on Franchise will decide how much Agent will get.
                </p>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-sm-6 col-xs-12">

        <div class="form-group">
            {!! Form::label('speed', 'Speed', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                {!! Form::text('speed', $service ? $service->speed : '', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('', 'Activate', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                {!! Form::checkbox('active', '', $service ? $service->active : '', ['id' =>'service_status']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', '', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                <button id="btn_save_service" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
