@extends('service::layouts.master')

@push('style')



@endpush

@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
        jQuery('select[name="exchange"]').on('change',function(){
               var exchangeID = jQuery(this).val();
               if(exchangeID)
               {
                  jQuery.ajax({
                     url : 'customer-commission/getexchange/' +exchangeID,
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
                     url : 'customer-commission/getstates/' +countryID,
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
                     url : 'customer-commission/getcity/' +stateID,
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

            jQuery('select[name="countall"]').on('change',function(){
               var countallID = jQuery(this).val();
               if(countallID)
               {
                  jQuery.ajax({
                     url : 'customer-commission/getcurrency/' +countallID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="comcount"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="comcount"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="comcount"]').empty();
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
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exchange">Exchange ID</label>
                            <select name="exchange" class="form-control">
                                <option value="">--- Select Exchange ---</option>
                                
                                <?php 
                               if (isset($exchange)){
                                foreach ($exchange as $franchise){
                                    if($franchise->approved_by == 1){
                                    ?>
                                    <option value="{{ $franchise->id }}">{{ $franchise->country }}</option>
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
                                if (isset($allagent)){
                                foreach ($allagent as $key => $value){?>
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
                <div class="col-md-7">
                <label for="code">Provider</label>
                <select name="provider_name" class="form-control">
                    <option value="">--- Select Provider Name ---</option>
                    <?php
                     if (isset($providesss)){
                    foreach ($providesss as $pro){?>
                        <option value="{{ $pro->name }}">{{ $pro->name }}</option>
                    <?php } }?>
                    
                    
                </select>
                </div>
                <div class="col-md-3">
                  <label for="code">Effect Date</label>
                  <input type="date" class="form-control" name="effect_date">
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-5">
                    <label for="code">Source Country</label>
                    <select style="text-transform: uppercase;" class="form-control" name="soureccountry" id="soureccountry">
                        <?php 
                         if (isset($countries)){
                        foreach ($countries as $country){?>
                            <option style="text-transform: uppercase;" value="{{ $country->iso_3166_3 }}">{{ $country->name }}</option>
                        <?php } }?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="code">Destination Country</label>
                    <select style="text-transform: uppercase;" class="form-control" name="destcountry" id="countall">
                        <?php 
                        if (isset($countries)){
                        foreach ($countries as $country){?>
                            <option style="text-transform: uppercase;" value="{{ $country->iso_3166_3 }}">{{ $country->name }}</option>
                        <?php } }?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-10" style="padding-left:0px;padding-right:0;">
                <label for="code">Select Charge</label>
                <select class="form-control" style="text-transform: uppercase;" name="chargesetup">

                    <option value="">Select Charge</option>
                        <?php 
                        if (isset($chargesetup)){
                        foreach($chargesetup as $charge)  {?> 
                        <option style="text-transform: uppercase;" value="{{$charge->name}}">
                        {{$charge->description}}
                        </option>
                        <?php } }?>
                </select>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="padding-left:0px;padding-right:0;">
            <button type="submit" class="btn btn-success btn-shar">Save</button>
            </div> 
        </form>
    </div>
@stop
