@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
<style>
    thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/services.js'))}}"></script>

<script>
    function edit_row(id)
    {
    var name=document.getElementById("name_val"+id).innerHTML;
    var age=document.getElementById("age_val"+id).innerHTML;

    document.getElementById("name_val"+id).innerHTML="<input type='text' id='name_text"+id+"' value='"+name+"'>";
    document.getElementById("age_val"+id).innerHTML="<input type='text' id='age_text"+id+"' value='"+age+"'>";
        
    document.getElementById("edit_button"+id).style.display="none";
    document.getElementById("save_button"+id).style.display="block";
    }

    function save_row(id)
    {
    var name=document.getElementById("name_text"+id).value;
    var age=document.getElementById("age_text"+id).value;
        
    $.ajax
    ({
    type:'post',
    url:'modify_records.php',
    data:{
    edit_row:'edit_row',
    row_id:id,
    name_val:name,
    age_val:age
    },
    success:function(response) {
    if(response=="success")
    {
        document.getElementById("name_val"+id).innerHTML=name;
        document.getElementById("age_val"+id).innerHTML=age;
        document.getElementById("edit_button"+id).style.display="block";
        document.getElementById("save_button"+id).style.display="none";
    }
    }
    });
    }
</script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Services
@endsection

@section('breadcrumb')
    
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Charge Setup List</a></li>
    
    <li class="active"><i class="fa fa-cog"></i> Manage Services</li>
@endsection

@section('content')

    <?php $min= 0; ?>
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_services" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th class="center">Payment Type</th>
                    <th class="center">Fixed Amount</th>
                    <th class="center">Min Amount</th>
                    <th class="center">Max Amount</th>
                    <th class="center">Charge Amount</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach($editcharges as $chargall){ ?>
                    <tr>
                     <td>{{$chargall->description}} </td>
                     <td>{{$chargall->dst_country}} </td>
                     <td>{{$chargall->minimum_weight}} </td>
                     <td>{{$chargall->maximum_weight}} </td>
                     <td>{{$chargall->price}} </td>
                     <td>
                        <input type='button' class="edit_button" id="edit_button<?php echo $chargall->id;?>" value="edit" onclick="edit_row('<?php echo $chargall->id ;?>');">
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@stop
