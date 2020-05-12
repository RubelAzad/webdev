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

@section('breadcrumb')
    <li><a href="{{url('service')}}"><i class="fa fa-cogs"></i> Services</a></li>
    <li class="active"><i class="fa fa-cog"></i> Create New Service</li>
@endsection

@section('content')
    <div class="container">

        <form action="" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" class="form-control" name="code">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="desc">
            </div>
            <div class="" style="margin-top: 10px;">
                <label>Fixed</label>
                <input type="radio" name="payment_type" id="credit" value="fixed">
                <div class="forcredit details">
                    <input type="text" name="fixednum">
                    <br>
                </div>
            </div>
            <div>
                <label>Slab</label>
                <input type="radio" name="payment_type" id="card" value="slab">
                <div class="forcard details">
                <table class="table table-bordered" id="dynamicTable">
                    <tr>
                        <th>Minimun Kg</th>
                        <th>Maximun Kg</th>
                        <th>Charge</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="addmore[0][name]" placeholder="Minimun Kg" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][qty]" placeholder="Maximun Kg" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][price]" placeholder="Charge" class="form-control" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@stop
