@extends('service::layouts.master')

@push('style')



@endpush

@push('scripts')
    <script>
      jQuery('select[name="exchange"]').on('change',function(){
               var exchangeID = jQuery(this).val();
               if(exchangeID)
               {
                  jQuery.ajax({
                     url : 'commission-sharing/getexchange/' +exchangeID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="exchname"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="exchname"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="exchname"]').empty();
               }
            });


            jQuery('select[name="franchise_count"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'commission-sharing/getstates/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="franchise_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="franchise_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="franchise_id"]').empty();
                  $('select[name="franchise_name"]').empty();
               }
            });
            jQuery('select[name="franchise_id"]').on('change',function(){
               var stateID = jQuery(this).val();
               if(stateID)
               {
                  jQuery.ajax({
                     url : 'commission-sharing/getcity/' +stateID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="franchise_name"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="franchise_name"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="franchise_name"]').empty();
               }
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
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exchange">Exchange ID</label>
                            <select name="exchange" class="form-control">
                                <option value="">--- Select Exchange ---</option>
                                <?php 
                                if ($shareexchange->count() && $i=1){
                                foreach ($shareexchange as $sharefranchise){
                                    if($sharefranchise->approved_by == 1){
                                    ?>
                                    <option value="{{ $sharefranchise->id }}">{{ $sharefranchise->country }}</option>
                               <?php } } }?>
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exchname">Exchange Name</label>
                            <select name="exchname" class="form-control">
                            <option>Name</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="country">Franchise Country</label>
                            <select name="franchise_count" class="form-control" id="franchise_count">
                                <option value="">--- Select Name ---</option>
                                <?php 
                                if (isset($shareallagent)){
                                foreach ($shareallagent as $key => $value){?>
                                    <option value="{{ $value->country }}">{{ $value->country }}</option>
                               <?php } }?>
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="franchise_id">ID</label>
                            <select name="franchise_id" class="form-control" id="franchise_id">
                            <option value="">Id</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="franchise_name">Franchise Name</label>
                            <select name="franchise_name" class="form-control" id="franchise_name">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                <label for="code">Provider</label>
                <select class="form-control" name="provider_name" id="provide">
                    <option value="">Select Country</option>
                    <?php 
                    if (isset($shareprovidesss)){
                    foreach ($shareprovidesss as $pro){?>
                        <option value="{{ $pro->name }}">{{ $pro->name }}</option>
                    <?php } }?>
                </select>
                </div>
                <div class="col-md-3">
                  <label for="code">Effect Date</label>
                  <input type="date" class="form-control" name="effect_date">
                </div>
                <div class="col-md-3">
                  <span style="display:block;"><label for="code">Applicable On</label></span>
                  <span class="share_app" style="display: inline-flex;margin-right:3px;"><input type="radio" class="form-control" style="width:15px; height:15px;color:#000;" name="charge_type" value="per_tra" checked> Per TT </span>
                  <span class="share_app" style="display: inline-flex;margin-right:3px;"><input type="radio" class="form-control" style="width:15px; height:15px;" name="charge_type" value="daily"> Daily </span>
                  <span class="share_app" style="display: inline-flex;"><input type="radio" class="form-control" style="width:15px; height:15px;" name="charge_type" value="monthly"> Monthly </span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-10">
                <label for="code">Select Charge</label>
                <select class="form-control" name="share_charge" id="share_charge">
                    <option value="">Select Country</option>
                    <?php if (isset($sharechargesetup)){
                      foreach ($sharechargesetup as $charshare) {?>
                        <option value="{{$charshare->desc}}">
                        {{$charshare->desc}}
                        </option>
                        <?php } }?>
                </select>
                </div>
              </div>
            </div>
            <div class="col-md-12">
            <button type="submit" class="btn btn-success btn-shar">Save</button>
            </div> 
        </form>
    </div>
@stop
