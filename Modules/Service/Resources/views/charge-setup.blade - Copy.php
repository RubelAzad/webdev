@extends('service::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url(Module::asset('service:css/form.css'))}}">
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
<script type="application/javascript" src="{{url(Module::asset('service:js/jquery.min.js'))}}"></script>
<script type="application/javascript" src="{{url(Module::asset('service:js/service-form.js'))}}"></script>

<script type="application/javascript">
    function addMore() {
        $("<div>").load("service::input", function() {
            $("#product").append($(this).html());
        });
    }
    function deleteRow() {
        $('div.product-item').each(function(index, item){
            jQuery(':checkbox', this).each(function () {
                if ($(this).is(':checked')) {
                    $(item).remove();
                }
            });
        });
    }

</script>
<script>
    export default {
        data() {
            return {
                name: '',
                nameState: null,
                submittedNames: []
            }
        },
        methods: {
            checkFormValidity() {
                const valid = this.$refs.form.checkValidity()
                this.nameState = valid ? 'valid' : 'invalid'
                return valid
            },
            resetModal() {
                this.name = ''
                this.nameState = null
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.handleSubmit()
            },
            handleSubmit() {
                // Exit when the form isn't valid
                if (!this.checkFormValidity()) {
                    return
                }
                // Push the name to submitted names
                this.submittedNames.push(this.name)
                // Hide the modal manually
                this.$nextTick(() => {
                    this.$refs.modal.hide()
                })
            }
        }
    }
</script>
@endpush

@section('breadcrumb')
<li><a href="{{url('service')}}"><i class="fa fa-cogs"></i> Services</a></li>
<li class="active"><i class="fa fa-cog"></i> Create New Service</li>
@endsection


@section('content')
<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="form-group" >
            {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => 'control-label col-md-4'])) !!}
            <div class="col-md-8" style="margin-bottom:10px;">
                {!! Form::text('name', $value = null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                {!! Form::textarea('description', $value = null, ['class' => 'form-control', 'rows' => 2]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Payment type', 'Payment type', ['class' => 'control-label col-md-4']) !!}
            <div class="col-md-8">
                <div>
                    <div class="" style="margin-top: 10px;">
                        <label>Fixed</label>
                        <input type="radio" name="payment_type" id="credit" value="fixed" required>
                        <div class="forcredit details">
                            <input type="text" name="fixednum" required=""><span style="color: red;">*</span>
                            <br>
                        </div>
                    </div>
                    <div>
                        <label>Slab</label>
                        <input type="radio" name="payment_type" id="card" value="slab">
                        <div class="forcard details">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="tdesign">
                                        <div class="forcard details">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Slab</th>
                                                    <th>Type</th>
                                                    <th>Charge</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>test</td>
                                                    <td>fixes</td>
                                                    <td>5</td>
                                                </tr>

                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-left: 0;padding-right: 0;">
                                    <div class="allbtn">
                                        <a class="btn btn-info btndesg" data-toggle="modal" data-target="#myModal">Add</a><br>
                                        <a href="" class="btn btn-success btndesg" data-toggle="modal" data-target="#myModal1">Edit</a><br>
                                        <a href="" class="btn btn-danger btndesg">Remove</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Slab Setup</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="/createcharge">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">For Min Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="min-amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">For Max Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="max-amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-4 pt-4">Charge in</label>
                            <div class="col-sm-4">
                                <div class="form-check form-add">
                                    <input class="form-check-input" type="radio" name="charge-type" id="gridRadios1" value="fixed" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Fixed
                                    </label>
                                </div>
                                <div class="form-check form-add">
                                    <input class="form-check-input" type="radio" name="charge-type" id="gridRadios2" value="percentage">
                                    <label class="form-check-label" for="gridRadios2">
                                        Percentage
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Charge Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="charge-amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success" data-dismiss="modal">Submit</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Slab Edit Setup</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">For Min Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="min-amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">For Max Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="min-amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-4 pt-4">Charge in</label>
                            <div class="col-sm-4">
                                <div class="form-check form-add">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Fixed
                                    </label>
                                </div>
                                <div class="form-check form-add">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Percentage
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Charge Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="min-amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
