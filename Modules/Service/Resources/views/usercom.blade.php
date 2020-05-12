@extends('service::layouts.master')

@push('style')



@endpush

@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
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
                        jQuery('select[name="state"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="state"]').empty();
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
                            <label for="country">Exchange ID</label>
                            <select name="country" class="form-control">
                                <option value="">--- Select Country ---</option>
                                @foreach ($countries as $key => $value)
                                <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="state">Exchange Name</label>
                            <select name="state" class="form-control">
                            <option>--State--</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-2">
                <label for="code">Franchise ID</label>
                <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country) 
                        <option value="$country->id">
                        {{$country->name}}
                        </option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-8">
                  <label for="code">Name</label>
                  <input type="text" class="form-control" name="code">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-7">
                <label for="code">Provider</label>
                <select class="form-control" name="provider">
                    <option value="">Select Country</option>
                    @foreach ($serprovider as $cprovide) 
                        <option value="$cprovide->id">
                        {{$cprovide->name}}
                        </option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-3">
                  <label for="code">Effect Date</label>
                  <input type="date" class="form-control" name="code">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                <label for="code">Country</label>
                <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    @foreach ($agent as $agentall) 
                        <option value="$agentall->id">
                        {{$agentall->name}}
                        </option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-5">
                  <label for="code">Currency</label>
                  <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country) 
                        <option value="$country->id">
                        {{$country->name}}
                        </option>
                    @endforeach
                </select>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-10">
                <label for="code">Select Charge</label>
                <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country) 
                        <option value="$country->id">
                        {{$country->name}}
                        </option>
                    @endforeach
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
