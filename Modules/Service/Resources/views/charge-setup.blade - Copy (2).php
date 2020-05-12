@extends('service::layouts.master')

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

        $("form").submit(function(e){
            e.preventDefault();
            var name = $("input[name='name']").val();
            var email = $("input[name='email']").val();
            var amount = $("input[name='amount']").val();

            $(".data-table tbody").append("<tr data-name='"+name+"' data-email='"+email+"' data-amount='"+amount+"'><td class='fname' name='mname[]'>"+name+"</td><td class='ename' name='memail[]'>"+email+"</td><td class='eamount' name='eamount[]'>"+amount+"</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");

            $("input[name='name']").val('');
            $("input[name='email']").val('');
            $("input[name='amount']").val('');
        });

        $("body").on("click", ".btn-delete", function(){
            $(this).parents("tr").remove();
        });

        $("body").on("click", ".btn-edit", function(){
            var name = $(this).parents("tr").attr('data-name');
            var email = $(this).parents("tr").attr('data-email');
            var amount = $(this).parents("tr").attr('data-amount');

            $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');
            $(this).parents("tr").find("td:eq(1)").html('<input name="edit_email" value="'+email+'">');
            $(this).parents("tr").find("td:eq(2)").html('<input name="edit_amount" value="'+amount+'">');

            $(this).parents("tr").find("td:eq(3)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")
            $(this).hide();
        });

        $("body").on("click", ".btn-cancel", function(){
            var name = $(this).parents("tr").attr('data-name');
            var email = $(this).parents("tr").attr('data-email');
            var amount = $(this).parents("tr").attr('data-amount');

            $(this).parents("tr").find("td:eq(0)").text(name);
            $(this).parents("tr").find("td:eq(1)").text(email);
            $(this).parents("tr").find("td:eq(2)").text(amount);

            $(this).parents("tr").find(".btn-edit").show();
            $(this).parents("tr").find(".btn-update").remove();
            $(this).parents("tr").find(".btn-cancel").remove();
        });

        $("body").on("click", ".btn-update", function(){
            var name = $(this).parents("tr").find("input[name='edit_name']").val();
            var email = $(this).parents("tr").find("input[name='edit_email']").val();
            var amount = $(this).parents("tr").find("input[name='edit_amount']").val();

            $(this).parents("tr").find("td:eq(0)").text(name);
            $(this).parents("tr").find("td:eq(1)").text(email);
            $(this).parents("tr").find("td:eq(2)").text(amount);

            $(this).parents("tr").attr('data-name', name);
            $(this).parents("tr").attr('data-email', email);
            $(this).parents("tr").attr('data-amount', amount);

            $(this).parents("tr").find(".btn-edit").show();
            $(this).parents("tr").find(".btn-cancel").remove();
            $(this).parents("tr").find(".btn-update").remove();
        });

    </script>

@endpush

@section('breadcrumb')
    <li><a href="{{url('service')}}"><i class="fa fa-cogs"></i> Services</a></li>
    <li class="active"><i class="fa fa-cog"></i> Create New Service</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <form method="post" action="">
                @csrf
                <div class="form-group" >
                    {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => 'control-label col-md-3'])) !!}
                    <div class="col-md-8" style="margin-bottom:10px;">
                        {!! Form::text('name1', $value = null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-8">
                        {!! Form::textarea('description', $value = null, ['class' => 'form-control', 'rows' => 2]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Payment type', 'Payment type', ['class' => 'control-label col-md-3']) !!}
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
                                                    <table class="table table-bordered data-table">
                                                        <thead>
                                                        <th>Form Range</th>
                                                        <th>To Range</th>
                                                        <th>Charge</th>
                                                        <th width="200px">Action</th>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-left: 0;padding-right: 0;">
                                            <div class="allbtn">
                                                <a class="btn btn-info btndesg" data-toggle="modal" data-target="#myModal">Add</a><br>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('', '', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-8">
                        <button id="btn_save_service" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
                    </div>
                </div>
            </form>
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
                    <form>

                        <div class="form-group">
                            <label>Form Amount Range:</label>
                            <input type="text" name="name" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label>To Amount Range:</label>
                            <input type="text" name="email" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Change:</label>
                            <input type="text" name="amount" class="form-control" required="">
                        </div>

                        <button type="submit" class="btn btn-success save-btn">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
