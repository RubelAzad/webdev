@extends('site::layouts.master')

@push('scripts')

@endpush

@section('breadcrumb')
    <li>Pages</li>
@endsection

@section('top_right_corner_button_group')
    @can('manage_contact', \Modules\Site\Entities\Site::class)
    <button id="addNewBtnId" class="btn my-3 btn-lg btn-danger">Add New </button>
    @endcan
@endsection


@section('page_header')
    Pages in website
@endsection

@section('content')
    

    <div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-3">

<button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>

<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">

  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
		<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>


<div id="WrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
		<h3>Something Went Wrong !</h3>
</div>
</div>
</div>





<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="serviceDeleteId" class="mt-4">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">

          <h5 id="serviceEditId" class="mt-4">   </h5>
          <div id="serviceEditForm" class="d-none w-100">
          <input id="serviceNameID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
          <input id="serviceDesID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
          <input id="serviceImgID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
          </div>

          <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h5 id="serviceEditWrong" class="d-none">Something Went Wrong !</h5>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">
          

          <div id="serviceAddForm" class=" w-100">
          <h6 class="mb-4">Add New Service</h6>  
          <input id="serviceNameAddID" type="text" id="" class="form-control mb-4" placeholder="Service Name">
          <input id="serviceDesAddID" type="text" id="" class="form-control mb-4" placeholder="Service Description">
          <input id="serviceImgAddID" type="text" id="" class="form-control mb-4" placeholder="Service Image Link">
          </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection




