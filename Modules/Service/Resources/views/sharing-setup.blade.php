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

            $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Minimun Kg" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Maximun Kg" class="form-control" /></td><td><span class="sha-income">Fixed <input type="radio" name="addmore['+i+'][income]" value="sfixed" class="form-control sradio" checked/></span><span class="sha-income">Persentage <input type="radio" name="addmore['+i+'][income]" value="spersent" class="form-control sradio"/></span></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Charge" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

    </script>

    <script>

      $(document).ready(function(){
        $("#text-inputt").prop('disabled', true);
        $('input[type=radio]').click(function(){
          if($(this).prop('id') == "lastt"){
          $("#text-inputt").prop("disabled", false);
          }else{
            $("#text-inputt").prop("disabled", true);
          }
          
        });
        $("#text-inputt1").prop('disabled', true);
        $('input[type=radio]').click(function(){
          if($(this).prop('id') == "lastt1"){
          $("#text-inputt1").prop("disabled", false);
          }else{
            $("#text-inputt1").prop("disabled", true);
          }
          
        });
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
            <div class="col-md-12">
              <div class="form-group col-md-3 cname">
                  <label for="code">Code:</label>
                  <input type="text" class="form-control" name="code">
              </div>
              <div class="form-group col-md-7 cname">
                  <label for="description">Description:</label>
                  <input type="text" class="form-control" name="desc">
              </div>
            </div>
            <div class="col-md-12" style="margin-bottom:5px;">
              <div class="col-md-4 shar">
                <div class="col-md-9">
                <label for="code">Sharing of:</label>
                </div>
                <div class="radio col-md-4">
                  <label><input type="radio" name="sharing" value="charge" checked>Charge</label>
                </div>
                <div class="radio col-md-6" style="margin-top:10px;">
                  <label><input type="radio" name="sharing" value="exchange">Exchange earning</label>
                </div>
              </div>
              <div class="col-md-4 shar">
                <div class="col-md-9">
                <label for="code">Direction:</label>
                </div>
                <div class="radio col-md-4">
                  <label><input type="radio" name="direction" value="issue" checked>Issue</label>
                </div>
                <div class="radio col-md-6" style="margin-top:10px;">
                  <label><input type="radio" name="direction" value="payment">Payment</label>
                </div>

              </div>
            </div>

            <div class="col-md-10">
              <div class="col-md-12 shar">
                <div class="col-md-12">
                  <label for="code">Charge Type:</label>
                </div>
                <div class="radio col-md-1">
                  <label><input type="radio" class='double-flavoured' name="charge" value="flat" checked>Flat</label>
                </div>
                <div class="radio col-md-3" style="margin-top:10px;">
                  <div class="col-md-6">
                   Percentage
                  </div>
                  <div class="col-md-6 carginpu">
                   <input type="number" name="share_per" >
                  </div>
                </div>
                <div class="radio col-md-3" style="margin-top:10px;">
                  <div class="col-md-6">
                   Minimum
                  </div>
                  <div class="col-md-6 carginpu">
                   <input type="number" name="share_mini" >
                  </div>
                </div>
                <div class="col-md-3" style="margin-top:10px;">
                  <div class="col-md-6">
                    <label><input type="radio" id="lastt" class='double-flavoured' name="charge" value="fixed">Fixed</label>
                    </div>
                    <div class="col-md-6 carginpu">
                    <input type="number" id="text-inputt" name="share_fixed" >
                  </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;">
                    <label><input type="radio" class='double-flavoured' name="charge" id="lastt" value="slab">Slab</label>

                    <div class="forcard details">
                      <table class="table table-bordered" id="dynamicTable">
                          <tr>
                              <th>Minimun Kg</th>
                              <th>Maximun Kg</th>
                              <th>Share of Income</th>
                              <th>Charge</th>
                              <th>Action</th>
                          </tr>
                          <tr>
                              <td><input type="text" name="addmore[0][name]" placeholder="Minimun Kg" class="form-control" /></td>
                              <td><input type="text" name="addmore[0][qty]" placeholder="Maximun Kg" class="form-control" /></td>
                              <td>
                                <span class="sha-income">Fixed <input type="radio" name="addmore[0][income]" placeholder="Share of income" value="sfixed" class="form-control sradio" checked/></span> 
                                <span class="sha-income">Persentage <input type="radio" name="addmore[0][income]" placeholder="Share of income" value="spersent" class="form-control sradio" /></span> 
                              </td>
                              <td><input type="text" name="addmore[0][price]" placeholder="Charge" class="form-control" /></td>
                              <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                          </tr>
                      </table>
                    </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-12">
            <button type="submit" class="btn btn-success btn-shar">Save</button>
            </div> 
        </form>
    </div>
@stop
