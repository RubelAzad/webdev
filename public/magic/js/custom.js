//For Services Table 
function getServicesData() {
  axios.get('/getServicesData')

      .then(function(response) {

          if (response.status == 200) {

              $('#mainDiv').removeClass('d-none');
              $('#loaderDiv').addClass('d-none');

              $('#service_table').empty();

              var jsonData = response.data;

              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td>" + jsonData[i].cname + "</td>" +
                      "<td>" + jsonData[i].cdes + "</td>" +
                      "<td>" + jsonData[i].cphone + "</td>" +
                      "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                      "<td><a  class='serviceDeleteBtn'  data-id=" + jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#service_table');
              });

               // Services Table Delete Icon Click
              $('.serviceDeleteBtn').click(function() {
                  var id = $(this).data('id');
                  $('#serviceDeleteId').html(id);
                  $('#deleteModal').modal('show');

              })

              // Services Table Edit Icon Click
              $('.serviceEditBtn').click(function() {
                  var id = $(this).data('id');
                  $('#serviceEditId').html(id);
                  ServiceUpdateDetails(id);
                  $('#editModal').modal('show');

              })


          } else {

              $('#loaderDiv').addClass('d-none');
              $('#WrongDiv').removeClass('d-none');

          }

      })
      .catch(function(error) {
          $('#loaderDiv').addClass('d-none');
          $('#WrongDiv').removeClass('d-none');
      });

}




// Services Delete Modal Yes Btn
$('#serviceDeleteConfirmBtn').click(function() {
  var id = $('#serviceDeleteId').html();
      ServiceDelete(id);
})

// Services Delete
function ServiceDelete(deleteID) {

$('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....

  axios.post('/ServiceDelete', {
          id: deleteID
      })
      .then(function(response) {
          $('#serviceDeleteConfirmBtn').html("Yes");
          if(response.status==200){
          if (response.data == 1) {
              $('#deleteModal').modal('hide');
              toastr.success('Delete Success');
              getServicesData();
          } else {
              $('#deleteModal').modal('hide');
              toastr.error('Delete Fail');
              getServicesData();
          }

          }
          else{
           $('#deleteModal').modal('hide');
           toastr.error('Something Went Wrong !');
          }

      })
      .catch(function(error) {
           $('#deleteModal').modal('hide');
           toastr.error('Something Went Wrong !');
      });
}



// Each Service Update Details 
function ServiceUpdateDetails(detailsID) {
  axios.post('/ServiceDetails', {
          id: detailsID
      })
      .then(function(response) {

              if(response.status==200){
                  $('#serviceEditForm').removeClass('d-none');
                  $('#serviceEditLoader').addClass('d-none');

                  var jsonData = response.data;
                  $('#serviceNameID').val(jsonData[0].service_name);
                  $('#serviceDesID').val(jsonData[0].service_des);
                  $('#serviceImgID').val(jsonData[0].service_img);
              }
              else{
                 $('#serviceEditLoader').addClass('d-none');
                 $('#serviceEditWrong').removeClass('d-none');
              }
  })
  .catch(function(error) {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
 });

}




// Services Edit Modal Save Btn
$('#serviceEditConfirmBtn').click(function() {
  var id = $('#serviceEditId').html();
  var name = $('#serviceNameID').val();
  var des = $('#serviceDesID').val();
  var img = $('#serviceImgID').val();
  ServiceUpdate(id,name,des,img);
})


function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg) {

  if(serviceName.length==0){
   toastr.error('Service Name is Empty !');
  }
  else if(serviceDes.length==0){
   toastr.error('Service Description is Empty !');
  }
  else if(serviceImg.length==0){
    toastr.error('Service Image is Empty !');
  }
  else{
  $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
  axios.post('/ServiceUpdate', {
          id: serviceID,
          name: serviceName,
          des: serviceDes,
          img: serviceImg,

      })
      .then(function(response) {
          $('#serviceEditConfirmBtn').html("Save");

          if(response.status==200){

            if (response.data == 1) {
              $('#editModal').modal('hide');
              toastr.success('Update Success');
              getServicesData();
          } else {
              $('#editModal').modal('hide');
              toastr.error('Update Fail');
              getServicesData();
          }  
       } 
       else{
          $('#editModal').modal('hide');
           toastr.error('Something Went Wrong !');
       }   

      
  })
  .catch(function(error) {
      $('#editModal').modal('hide');
      toastr.error('Something Went Wrong !');
 });

}

}


// Service Add New btn Click

$('#addNewBtnId').click(function(){
 $('#addModal').modal('show');
});



// Services Edit Modal Save Btn
$('#serviceAddConfirmBtn').click(function() {
  var name = $('#serviceNameAddID').val();
  var des = $('#serviceDesAddID').val();
  var img = $('#serviceImgAddID').val();
  ServiceAdd(name,des,img);
})


// Service Add Method

function ServiceAdd(serviceName,serviceDes,serviceImg) {

  if(serviceName.length==0){
   toastr.error('Service Name is Empty !');
  }
  else if(serviceDes.length==0){
   toastr.error('Service Description is Empty !');
  }
  else if(serviceImg.length==0){
    toastr.error('Service Image is Empty !');
  }
  else{
  $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
  axios.post('/ServiceAdd', {
          name: serviceName,
          des: serviceDes,
          img: serviceImg,
      })
      .then(function(response) {
          $('#serviceAddConfirmBtn').html("Save");

          if(response.status==200){

            if (response.data == 1) {
              $('#addModal').modal('hide');
              toastr.success('Add Success');
              getServicesData();
          } else {
              $('#addModal').modal('hide');
              toastr.error('Add Fail');
              getServicesData();
          }  
       } 
       else{
           $('#addModal').modal('hide');
           toastr.error('Something Went Wrong !');
       }   

  })
  .catch(function(error) {
           $('#addModal').modal('hide');
           toastr.error('Something Went Wrong !');
 });

}

}
